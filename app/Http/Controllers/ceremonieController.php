<?php

namespace App\Http\Controllers;
use App\Ceremonie;
use Illuminate\Http\Request;
use App\Repositories\Repository;
class ceremonieController extends Controller
{

    protected $model;

    public function __construct(Ceremonie $exemple){
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

        if ($request->hasFile('fichier')){
            $fullName=$request->file('fichier')->getClientOriginalName();
            $name=pathinfo($fullName,PATHINFO_FILENAME);
            $extension=$request->file('fichier')->getClientOriginalExtension();
            $nameTosore=$name.'_!'.time().'.'.$extension;
            $destination= public_path('/fichier_image');
            $fichier=$request->file('fichier')->move($destination, $nameTosore);
            $fichier=url('/fichier_image').'/'.$nameTosore;
        }
        $resultat=new Ceremonie();
        $resultat->date_debut=$request->get("date_debut");
        $resultat->heure_debut=$request->get("heure_debut");
        $resultat->date_fin=$request->get("date_fin");
        $resultat->heure_fin=$request->get("heure_fin");
        $resultat->objet_ceremonie=$request->get("objet_ceremonie");
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
        //

        $resultat=Ceremonie::find($request->input("id"));

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

        $resultat->date_debut=$request->get("date_debut");
        $resultat->heure_debut=$request->get("heure_debut");
        $resultat->date_fin=$request->get("date_fin");
        $resultat->heure_fin=$request->get("heure_fin");
        $resultat->objet_ceremonie=$request->get("objet_ceremonie");
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
        return $this->model->destroy($id);
    }
}
