<?php

namespace App\Http\Controllers;

use App\Models\Cruce;
use App\Http\Requests\StoreCruceRequest;
use App\Http\Requests\UpdateCruceRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;


class CruceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("Cruce.CRUD");
    }


    public function pdf(){

        App::setLocale('es');

        $fechaActual = Carbon::now()->format('d \\de F \\de Y');
        $cruces= Cruce::all();
        $pdf = Pdf::loadView('Cruce.PDF', compact('cruces', 'fechaActual'));
        return $pdf->stream();
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCruceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cruce $cruce)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cruce $cruce)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCruceRequest $request, Cruce $cruce)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cruce $cruce)
    {
        //
    }
}
