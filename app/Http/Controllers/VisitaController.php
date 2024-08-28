<?php

namespace App\Http\Controllers;

use App\LugarMasaje;
use App\Reserva;
use App\Ubicacion;
use App\Visita;
use Illuminate\Http\Request;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($reserva)
    {
        $reserva = Reserva::findOrFail($reserva);

        return view('themes.backoffice.pages.visita.create', [
            'reserva' => $reserva,
            'ubicaciones' => Ubicacion::all(),
            'lugares' => LugarMasaje::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Reserva $reserva)
    {
        dd($request);
        $visita = Visita::create([
            'horario_sauna' => Carbon::CreateFromFormat('h:i A'),

        ]);
        Alert::success('Éxito', 'Se ha generado la visita')->showConfirmButton();
        return redirect()->route('backoffice.reserva.show', ['reserva' => $reserva->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function show(Visita $visita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function edit(Visita $visita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visita $visita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visita  $visita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visita $visita)
    {
        //
    }
}
