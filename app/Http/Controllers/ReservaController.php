<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Http\Requests\Reserva\StoreRequest;
use App\Programa;
use App\Reserva;
use App\TipoTransaccion;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Carbon::setLocale('es');

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

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
        $programas = Programa::all();
        $tipos = TipoTransaccion::all();

        return view('themes.backoffice.pages.reserva.create', [
            'cliente' => $cliente,
            'programas' => $programas,
            'tipos' => $tipos,
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
        // $reserva = $reserva->store($request);
        // dd($request);

        // Iniciar la transacción
        DB::transaction(function () use ($request, &$reserva) {
            // Asignar el id del cliente con la reserva
            if ($request->has('cliente_id')) {
                $cliente = $request->cliente_id;
                $request->merge(['cliente_id' => $cliente]);
            }

            // Asignar el user_id del usuario autenticado
            $user_id = auth()->id();
            $request->merge(['user_id' => $user_id]);

            // Crear la reserva
            $reserva = Reserva::create($request->all()); // Cambiado de self::create a Reserva::create

            // Generar url para almacenar imagen
            $url_abono = null;

            if ($request->hasFile('imagen_abono')) {
                $abono = $request->file('imagen_abono');
                $filename = time() . '-' . $abono->getClientOriginalName();
                Storage::disk('imagen_abono')->put($filename, File::get($abono));
                $url_abono = $filename;
            }

            // Crear la venta relacionada con la reserva
            Venta::create([
                'id_reserva' => $reserva->id, // Usar el ID de la reserva generada
                'abono_programa' => $request->abono_programa,
                'imagen_abono' => $url_abono,
                'id_tipo_transaccion_abono' => $request->id_tipo_transaccion_abono,
                'total_pagar' => $request->total_pagar,
            ]);
        });

        // Mostrar alerta de éxito
        Alert::success('Éxito', 'Reserva realizada con éxito', 'Confirmar')->showConfirmButton();

        // Redirigir fuera de la transacción
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
            'reserva' => $reserva,
        ]);
    }

    public function showAbonoImage($id)
    {
        $reserva = Reserva::findOrFail($id);

        // Verificar si el archivo de abono existe
        if (Storage::disk('imagen_abono')->exists($reserva->venta->imagen_abono)) {
            $file = Storage::disk('imagen_abono')->get($reserva->venta->imagen_abono);
            $mimeType = Storage::disk('imagen_abono')->mimeType($reserva->venta->imagen_abono);

            return response($file, 200)->header('Content-Type', $mimeType);
        }

        return abort(404, 'Imagen de abono no encontrada');
    }

    public function showDiferenciaImage($id)
    {
        $reserva = Reserva::findOrFail($id);

        // Verificar si el archivo de diferencia existe
        if (Storage::disk('imagen_diferencia')->exists($reserva->venta->imagen_diferencia)) {
            $file = Storage::disk('imagen_diferencia')->get($reserva->venta->imagen_diferencia);
            $mimeType = Storage::disk('imagen_diferencia')->mimeType($reserva->venta->imagen_diferencia);

            return response($file, 200)->header('Content-Type', $mimeType);
        }

        // return abort(404, 'Imagen de diferencia no encontrada');
        return redirect('https://via.placeholder.com/200x300');
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
