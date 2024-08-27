<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\Reserva\StoreRequest;
use App\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Configurar Carbon para que use el idioma español
        Carbon::setLocale('es');

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Obtener todas las reservas agrupadas por mes y año
        $reservasPorMes = Reserva::with('cliente')
            ->orderBy('fecha_visita')
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->fecha_visita)->format('Y-m');
            });

        return view('themes.backoffice.pages.reserva.index', compact('reservasPorMes', 'currentMonth', 'currentYear'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cliente)
    {
        $cliente = Cliente::findOrFail($cliente);

        return view('themes.backoffice.pages.reserva.create', [
            'cliente' => $cliente,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Reserva $reserva)
    {
        $reserva = $reserva->store($request);
        return redirect()->route('backoffice.cliente.show', ['cliente' => $reserva->cliente_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        return view('themes.backoffice.pages.reserva.show', [
            'reserva'=>$reserva
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
