<?php

namespace App\Http\Controllers;

use App\Insumo;
use App\Sector;
use App\UnidadMedida;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sectores = Sector::all();
        $unidades = UnidadMedida::all();
        // Verificar si existe un parámetro de sector para el filtrado
        if ($request->has('sector_id')) {
            // Filtrar los insumos por sector
            $insumos = Insumo::where('id_sector', $request->sector_id)->get();
        } else {
            // Obtener todos los insumos si no se ha seleccionado ningún sector
            $insumos = Insumo::all();
        }

        return view('themes.backoffice.pages.insumo.index', compact('insumos', 'sectores', 'unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectores = Sector::all();
        $unidades = UnidadMedida::all();

        return view('themes.backoffice.pages.insumo.create', compact('sectores', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        Insumo::create($request);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function show(Insumo $insumo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function edit(Insumo $insumo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Insumo $insumo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insumo  $insumo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insumo $insumo)
    {
        //
    }
}
