<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\User;
use App\Reserva;
use App\Insumo;
use App\Menu;
use App\Visita;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:' . config('app.admin_role') . '-' . config('app.anfitriona_role') . '-' . config('app.cocina_role') . '-' . config('app.garzon_role'). '-' . config('app.masoterapeuta_role'));
    }

    public function show()
    {
        // Contar el número total de clientes
        $totalClientes = Cliente::count();

        // Contar el número total de reservas
        $totalReservas = Reserva::count();

        $insumosCriticos = Insumo::whereColumn('cantidad', '<=', 'stock_critico')->get();

        $user = auth()->user();


        if ($user->has_role(config('app.admin_role'))) {
            
            return view('themes.backoffice.pages.admin.show', compact('totalClientes','totalReservas','insumosCriticos'));
        }

        if ($user->has_role(config('app.anfitriona_role'))) {
            return redirect()->action([ReservaController::class, 'index']);
        }

        if ($user->has_role(config('app.cocina_role')) || $user->has_role(config('app.garzon_role'))) {
            return redirect()->action([MenuController::class, 'index']);
        }

        if ($user->has_role(config('app.masoterapeuta_role'))) {
            return redirect()->action([VisitaController::class, 'masajeindex']);
        }
    }
}
