<?php

namespace App\Http\Controllers;

use App\LugarMasaje;
use App\Reserva;
use App\Ubicacion;
use App\Visita;
use Illuminate\Http\Request;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

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
        $serviciosDisponibles = $reserva->programa->servicios->pluck('nombre_servicio')->toArray();



        return view('themes.backoffice.pages.visita.create', [
            'reserva' => $reserva,
            'ubicaciones' => Ubicacion::all(),
            'lugares' => LugarMasaje::all(),
            'servicios' => $serviciosDisponibles,
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

        $sauna = null;
        $tinaja = null;
        $masaje = null;
    
        if ($request->has('horario_sauna')) {
            $sauna = Carbon::CreateFromFormat('h:i A', $request->input('horario_sauna'));
        }
        if ($request->has('horario_tinaja')) {
            $tinaja = Carbon::CreateFromFormat('h:i A', $request->input('horario_tinaja'));
        }
        if ($request->has('horario_masaje')) {
            $masaje = Carbon::CreateFromFormat('h:i A', $request->input('horario_masaje'));
        }
    
        $visita = Visita::create([
            'id_reserva' => $request->input('id_reserva'),
            'trago_cortesia' => $request->input('trago_cortesia'),
            'alergias' => $request->input('alergias'),
            'observacion' => $request->input('observacion'),
            'id_ubicacion' => $request->input('id_ubicacion'),
            'id_lugar_masaje' => $request->input('id_lugar_masaje'),
            'horario_sauna' => $sauna,
            'horario_tinaja' => $tinaja,
            'horario_masaje' => $masaje,
        ]);

        Alert::success('Éxito', 'Se ha generado la visita')->showConfirmButton();
        return redirect()->route('backoffice.reserva.show', ['reserva' => $request->input('id_reserva')]);
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
