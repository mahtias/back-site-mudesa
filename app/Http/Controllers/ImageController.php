<?php

namespace App\Http\Controllers;
use App\Image;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $model;
    public function __construct(Image $exemple){
        $this->model = new Repository($exemple);
       // $this->middleware('auth:api', ['except' => ['login']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    return $this->model->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('fichier')){
            $fullName=$request->file('fichier')->getClientOriginalName();
            $name=pathinfo($fullName,PATHINFO_FILENAME);
            $extension=$request->file('fichier')->getClientOriginalExtension();
            $nameTosore=$name.'_!'.time().'.'.$extension;
            $destination= public_path('/fichier_image');
            $fichier=$request->file('fichier')->move($destination, $nameTosore);
            $fichier=url('/fichier_image').'/'.$nameTosore;
        }
        $resultat=new Image();
        $resultat->date=$request->get("date");
        $resultat->fichier=$fichier;
        $resultat->save();
        return response()->json($resultat, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resultat=Image::find($request->input("id"));

        if ($request->hasFile('fichier')){
            $fullName=$request->file('fichier')->getClientOriginalName();
            $name=pathinfo($fullName,PATHINFO_FILENAME);
            $extension=$request->file('fichier')->getClientOriginalExtension();
            $nameTosore=$name.'_!'.time().'.'.$extension;
            $destination= public_path('/fichier_image');
            $fichier=$request->file('fichier')->move($destination, $nameTosore);
            $fichier=url('/fichier_image').'/'.$nameTosore;
            $resultat->fichier=$fichier;
        }

        $resultat->date=$request->get("date");
        $resultat->save();
        return response()->json($resultat, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     return $this->model->delete($id);
    }
}
