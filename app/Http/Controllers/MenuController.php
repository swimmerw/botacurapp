<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Reserva;
use App\Visita;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class MenuController extends Controller
{

    public function index()
    {
        Carbon::setLocale('es');

        // Vista actual
        $fechaActual = Carbon::now()->startOfDay();

        $reservas = Reserva::where('fecha_visita', '>=', $fechaActual)
        ->with(['cliente', 'visitas'=>function($q){
            $q->with('menus')  // Incluir los menús asociados a la visita
              ->orderBy('horario_sauna', 'desc');
        }, 'programa.servicios'])
        ->orderBy('fecha_visita')
        ->get();


        // Agrupar reservas por fecha
        $menusPorDia = $reservas->groupBy(function ($reserva) {
            return Carbon::parse($reserva->fecha_visita)->format('d-m-Y');
        });
        

                // Paginación manual de los días
                $perPage = 1; // Número de días por página
                $currentPage = LengthAwarePaginator::resolveCurrentPage();
                $currentItems = $menusPorDia->slice(($currentPage - 1) * $perPage, $perPage)->all();
        
                // Crear el paginador manualmente
                $menusPaginados = new LengthAwarePaginator($currentItems, $menusPorDia->count(), $perPage, $currentPage);
                $menusPaginados->setPath(request()->url());


        return view('themes.backoffice.pages.cocina.index', compact('menusPaginados'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Menu $menu)
    {
        //
    }


    public function edit(Menu $menu)
    {
        //
    }


    public function update(Request $request, Menu $menu)
    {
        //
    }


    public function destroy(Menu $menu)
    {
        //
    }
}
