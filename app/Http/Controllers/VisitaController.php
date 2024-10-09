<?php

namespace App\Http\Controllers;

use App\LugarMasaje;
use App\Mail\RegistroReservaMailable;
use App\Menu;
use App\Producto;
use App\Reserva;
use App\Ubicacion;
use App\Visita;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
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
        // Asignacion de dias Hoy y Mañana
        $hoy = Carbon::today();
        $manana = Carbon::tomorrow();

        // Filtrar las reservas que tienen visitas y cuya fecha de visita es hoy o mañana
        $reservas = Reserva::with('visitas', 'cliente', 'programa', 'user')
            ->whereBetween('fecha_visita', [$hoy, $manana])
            ->get();

        // Filtrar por visitas de Hoy
        $reservasHoy = $reservas->filter(function ($reserva) use ($hoy) {
            return Carbon::parse($reserva->fecha_visita)->isSameDay($hoy);
        });

        // Filtrar por visitas de Mañana
        $reservasManana = $reservas->filter(function ($reserva) use ($manana) {
            return Carbon::parse($reserva->fecha_visita)->isSameDay($manana);
        });

        //Retorno de la vista
        return view('themes.backoffice.pages.visita.index', [
            'reservasHoy' => $reservasHoy,
            'reservasManana' => $reservasManana,
            //Reservas para la relacion con visitas
            // 'reservas' => Reserva::with('cliente', 'programa', 'user')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($reserva)
    {
        $masajesExtra = session()->get('masajesExtra');

        $reserva = Reserva::findOrFail($reserva);
        $serviciosDisponibles = $reserva->programa->servicios->pluck('nombre_servicio')->toArray();

        // Obtenemos la fecha seleccionada del formulario
        $fechaSeleccionada = \Carbon\Carbon::createFromFormat('d-m-Y', $reserva->fecha_visita)->format('Y-m-d');

        // ===============================HORAS=SPA==============================================
        // Horarios disponibles de 10:00 a 18:30 SPA
        $horaInicio = new \DateTime('10:00');
        $horaFin = new \DateTime('18:30');
        $intervalo = new \DateInterval('PT30M');
        $horarios = [];

        while ($horaInicio <= $horaFin) {
            $horarios[] = $horaInicio->format('H:i');
            $horaInicio->add($intervalo);
        }

        // Obtener horarios ocupados de la tabla 'visitas'
        $horariosOcupados = DB::table('visitas')
            ->join('reservas', 'visitas.id_reserva', '=', 'reservas.id')
            ->where('reservas.fecha_visita', $fechaSeleccionada)
            ->pluck('visitas.horario_sauna')
            ->map(function ($hora) {
                return \Carbon\Carbon::createFromFormat('H:i:s', $hora)->format('H:i');
            })
            ->toArray();

        // Filtrar horarios disponibles
        $horariosDisponiblesSPA = array_diff($horarios, $horariosOcupados);

        //=================================HORAS=MASAJES=========================================

        // Horarios disponibles de 10:20 a 19:00 con intervalos de 10 minutos entre sesiones de masaje
        $horaInicio = new \DateTime('10:20');
        $horaFin = new \DateTime('19:00');
        $duracionMasaje = new \DateInterval('PT30M'); // 30 minutos de duración
        $intervalo = new \DateInterval('PT10M'); // 10 minutos de intervalo entre sesiones
        $horarios = [];

        while ($horaInicio <= $horaFin) {
            $horarios[] = $horaInicio->format('H:i');
            $horaInicio->add($duracionMasaje);
            $horaInicio->add($intervalo);
        }

        // Obtener las horas de inicio ocupadas de la tabla 'visitas' para masajes
        $horariosOcupados = DB::table('visitas')
            ->join('reservas', 'visitas.id_reserva', '=', 'reservas.id')
            ->where('reservas.fecha_visita', $fechaSeleccionada)
            ->pluck('visitas.horario_masaje')
            ->map(function ($hora) {
                return \Carbon\Carbon::createFromFormat('H:i:s', $hora)->format('H:i');
            })
            ->toArray();

        // Filtrar horarios disponibles (ajusta si ocupas rangos completos)
        $horariosDisponiblesMasajes = array_diff($horarios, $horariosOcupados);

        // Obtener productos de tipo "entrada"
        $entradas = Producto::whereHas('tipoProducto', function ($query) {
            $query->where('nombre', 'entrada');
        })->get();

        // Obtener productos de tipo "fondo"
        $fondos = Producto::whereHas('tipoProducto', function ($query) {
            $query->where('nombre', 'fondo');
        })->get();

        // Obtener productos de tipo "postre"
        $acompañamientos = Producto::whereHas('tipoProducto', function ($query) {
            $query->where('nombre', 'acompañamiento');
        })->get();

        return view('themes.backoffice.pages.visita.create', [
            'reserva' => $reserva,
            'ubicaciones' => Ubicacion::all(),
            'lugares' => LugarMasaje::all(),
            'servicios' => $serviciosDisponibles,
            'horarios' => $horariosDisponiblesSPA,
            'horasMasaje' => $horariosDisponiblesMasajes,
            'entradas' => $entradas,
            'fondos' => $fondos,
            'acompañamientos' => $acompañamientos,
            'masajesExtra' => $masajesExtra,
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
        $masaje = null;
        $tipoMasaje = null;
        $visita = null;
        $cliente = null;
        $programa = $reserva->programa;

        if ($request->has('horario_sauna')) {
            $sauna = Carbon::CreateFromFormat('H:i', $request->input('horario_sauna'));
        }

        if ($request->has('horario_masaje')) {
            $masaje = Carbon::CreateFromFormat('H:i', $request->input('horario_masaje'));
        }

        if ($request->has('tipo_masaje')) {
            $tipoMasaje = $request->tipo_masaje;
        }

        try {
            DB::transaction(function () use ($request, &$reserva, $sauna, $masaje, &$visita, &$cliente, $tipoMasaje) {

                $cliente = $reserva->cliente;

                $visita = Visita::create([
                    'id_reserva' => $request->input('id_reserva'),
                    'trago_cortesia' => $request->input('trago_cortesia'),
                    'alergias' => $request->input('alergias'),
                    'observacion' => $request->input('observacion'),
                    'id_ubicacion' => $request->input('id_ubicacion'),
                    'id_lugar_masaje' => $request->input('id_lugar_masaje'),
                    'horario_sauna' => $sauna,
                    'horario_masaje' => $masaje,
                    'tipo_masaje' => $tipoMasaje,
                ]);

                $tinaja = $visita->hora_fin_sauna;

                $visita->update([
                    'horario_tinaja' => $tinaja,
                ]);

                foreach ($request->menus as $menu) {
                    Menu::create([
                        'id_visita' => $visita->id,
                        'id_producto_entrada' => $menu['id_producto_entrada'],
                        'id_producto_fondo' => $menu['id_producto_fondo'],
                        'id_producto_acompanamiento' => $menu['id_producto_acompanamiento'],
                        'observacion' => $menu['observacion'],
                    ]);
                }

            });

            if ($cliente && $visita) {
                Mail::to($cliente->correo)->send(new RegistroReservaMailable($visita, $reserva, $cliente, $programa));
            }

            Alert::success('Éxito', 'Se ha generado la visita')->showConfirmButton();

            session()->forget('masajesExtra');

            return redirect()->route('backoffice.reserva.show', ['reserva' => $request->input('id_reserva')]);

        } catch (\Exception $e) {
            Alert::error('Error', 'Ocurrió un problema al generar la visita. Intente nuevamente.')->showConfirmButton();
            return redirect()->back()->withInput();
        }

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

    public function masajeindex()
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
}
