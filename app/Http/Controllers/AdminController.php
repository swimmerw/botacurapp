<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\User;
use App\Reserva;
use App\Insumo;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:' . config('app.admin_role') . '-' . config('app.anfitriona_role'));
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
    }
}
