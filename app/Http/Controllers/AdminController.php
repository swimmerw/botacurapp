<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Insumo;
use App\Masaje;
use App\Reserva;
use App\User;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('role:' . config('app.admin_role') . '-' . config('app.anfitriona_role') . '-' . config('app.cocina_role') . '-' . config('app.garzon_role') . '-' . config('app.masoterapeuta_role'));
    }

    public function show()
    {
        // Contar el número total de clientes
        $totalClientes = Cliente::count();

        // Contar el número total de reservas
        $totalReservas = Reserva::count();

        $insumosCriticos = Insumo::whereColumn('cantidad', '<=', 'stock_critico')->get();

        $masajesAsignados = Masaje::count();

        $user = auth()->user();

        if ($user->has_role(config('app.admin_role'))) {

            return view('themes.backoffice.pages.admin.show', compact('totalClientes', 'totalReservas', 'insumosCriticos', 'masajesAsignados'));
        }

        if ($user->has_role(config('app.anfitriona_role'))) {
            return redirect()->action([ReservaController::class, 'index']);
        }

        if ($user->has_role(config('app.cocina_role')) || $user->has_role(config('app.garzon_role'))) {
            return redirect()->action([MenuController::class, 'index']);
        }

        if ($user->has_role(config('app.masoterapeuta_role'))) {
            return redirect()->action([MasajeController::class, 'index']);
        }
    }

    public function index()
    {
        Carbon::setLocale('es');
        $masajes = Masaje::with('users', 'visitas');

        // Obtener usuarios con el rol de masoterapeuta
        $masoterapeutas = User::whereHas('roles', function ($query) {
            $query->where('name', 'masoterapeuta');
        })->get();

        // Obtener la cantidad de masajes realizados por cada masoterapeuta en la semana en curso
        $inicioSemana = Carbon::now()->startOfWeek();
        $finSemana = Carbon::now()->endOfWeek();

        // Crear un array para almacenar la cantidad de masajes por semana y por día por masoterapeuta
        $cantidadMasajesPorSemana = [];
        $cantidadMasajesPorDia = [];

        foreach ($masoterapeutas as $masoterapeuta) {
            // Cantidad total de masajes en la semana por masoterapeuta
            $cantidadMasajesPorSemana[$masoterapeuta->id] = Masaje::where('user_id', $masoterapeuta->id)
                ->whereBetween('created_at', [$inicioSemana, $finSemana])
                ->count();

            // Cantidad de masajes por cada día de la semana
            $masajesPorDia = Masaje::where('user_id', $masoterapeuta->id)
                ->whereBetween('created_at', [$inicioSemana, $finSemana])
                ->get()
                ->groupBy(function ($masaje) {
                    return Carbon::parse($masaje->created_at)->format('l');
                });

            // Crear un array para contener la cantidad de masajes por día
            $cantidadMasajesPorDia[$masoterapeuta->id] = [];
            foreach (Carbon::getDays() as $dia) {
                $cantidadMasajesPorDia[$masoterapeuta->id][$dia] = isset($masajesPorDia[$dia]) ? $masajesPorDia[$dia]->count() : 0;
            }
        }

        return view('themes.backoffice.pages.admin.index', [
            'masoterapeutas' => $masoterapeutas,
            'cantidadMasajesPorSemana' => $cantidadMasajesPorSemana,
            'cantidadMasajesPorDia' => $cantidadMasajesPorDia,
        ]);
    }
}
