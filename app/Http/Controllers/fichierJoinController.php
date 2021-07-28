<?php

namespace App\Http\Controllers;
use App\Repositories\Repository;
use Illuminate\Http\Request;
 use App\fichier_joint;

class fichierJoinController extends Controller
{
    protected $model;

    public function __construct(fichier_joint $exemple){
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
        //
        if ($request->hasFile('fichier_join')){
            $fullName=$request->file('fichier_join')->getClientOriginalName();
            $name=pathinfo($fullName,PATHINFO_FILENAME);
            $extension=$request->file('fichier_join')->getClientOriginalExtension();
            $nameTosore=$name.'_!'.time().'.'.$extension;
            $destination= public_path('/rapport_reunion');
            $fichier=$request->file('fichier_join')->move($destination, $nameTosore);
            $fichier=url('/rapport_reunion').'/'.$nameTosore;
        }
        $resultat=new fichier_joint();
        $resultat->date_rapport=$request->get("date_rapport");
        $resultat->heure_rapport=$request->get("heure_rapport");
        $resultat->fichier_join=$fichier;
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
        return $this->model->show($id);

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
        //
        $resultat=fichier_joint::find($request->input("id"));

        if ($request->hasFile('fichier_join')){
            $fullName=$request->file('fichier_join')->getClientOriginalName();
            $name=pathinfo($fullName,PATHINFO_FILENAME);
            $extension=$request->file('fichier_join')->getClientOriginalExtension();
            $nameTosore=$name.'_!'.time().'.'.$extension;
            $destination= public_path('/rapport_reunion');
            $fichier=$request->file('fichier_join')->move($destination, $nameTosore);
            $fichier=url('/rapport_reunion').'/'.$nameTosore;
            $resultat->fichier_join=$fichier;
        }

          $resultat->date_rapport=$request->get("date_rapport");
        $resultat->heure_rapport=$request->get("heure_rapport");
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
        //
        return $this->model->delete($id);
    }
}
