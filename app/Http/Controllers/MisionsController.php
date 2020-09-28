<?php

namespace App\Http\Controllers;
use App\misions;
use Illuminate\Http\Request;
use App\Repositories\Repository;
class MisionsController extends Controller
{
    protected $model;

    public function __construct(misions $exemple){
        $this->model = new Repository($exemple);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->model->with(['categorieMission','typeMission','personnel'
            ,'moyenTransport','modePaiement','anneeMission'])->get(); 
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
         $exemple = new misions;
        $creation = $exemple->create($request->only($exemple->fillable));
        return response()->json(misions::with(['categorieMission',
            'typeMission','personnel','moyenTransport',
            'modePaiement','anneeMission'])->find($creation->id),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
         $this->model->update($request->only($this->model->getModel()->fillable), $id);

        return response()->json(misions::with(['categorieMission',
            'typeMission','personnel','moyenTransport','modePaiement',
            'anneeMission'])->find($id));
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
