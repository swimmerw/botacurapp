<?php

namespace App\Http\Controllers;

use App\Masaje;
use App\Reserva;
use App\Visita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class MasajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Asignacion de dias Hoy y Mañana
        $hoy = Carbon::today();
        $manana = Carbon::tomorrow();
    
        // Filtrar las reservas que tienen visitas y cuya fecha de visita es hoy o mañana
        $reservas = Reserva::with('visitas', 'cliente', 'programa', 'user')
            ->whereBetween('fecha_visita', [$hoy, $manana])
            ->get();
    
        // Ordenar las reservas por horario_masaje de la visita
        $reservas = $reservas->sortBy(function ($reserva) {
            return optional($reserva->visitas->first())->horario_masaje;
        });
    
        // Filtrar por visitas de Hoy
        $reservasHoy = $reservas->filter(function ($reserva) use ($hoy) {
            return Carbon::parse($reserva->fecha_visita)->isSameDay($hoy);
        });
    
        // Filtrar por visitas de Mañana
        $reservasManana = $reservas->filter(function ($reserva) use ($manana) {
            return Carbon::parse($reserva->fecha_visita)->isSameDay($manana);
        });
    
    
        //Retorno de la vista
        return view('themes.backoffice.pages.masaje.index', [
            'reservasHoy' => $reservasHoy,
            'reservasManana' => $reservasManana,
        ]);
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
                // Validar la solicitud
                $request->validate([
                    'id_visita' => 'required|exists:visitas,id',
                    'persona_numero' => 'required|integer|min:1',
                ]);
        
                $masaje = Masaje::create([
                    'persona' => $request->persona_numero,
                    'id_visita' => $request->id_visita,
                    'user_id' => auth()->id(),
                ]);
        
        
                // Redirigir con un mensaje de éxito
                Alert::toast('Masaje asignado correctamente', 'success');
                return redirect()->back()->with('success', 'Masaje asignado correctamente');
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
    }
}
