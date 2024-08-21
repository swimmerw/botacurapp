<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Reserva;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:' . config('app.admin_role'));
    }

    public function show()
    {
        // Contar el número total de clientes
        $totalClientes = Cliente::count();

        // Contar el número total de reservas
        $totalReservas = Reserva::count();

        return view('themes.backoffice.pages.admin.show', compact('totalClientes','totalReservas'));
    }
}
