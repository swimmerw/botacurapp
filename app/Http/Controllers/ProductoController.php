<?php

namespace App\Http\Controllers;

use App\Insumo;
use App\Producto;
use App\TipoProducto;
use App\UnidadMedida;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoProducto::all();
        $productos = Producto::all();
        $unidades = UnidadMedida::all();
        return view('themes.backoffice.pages.producto.index', compact('productos', 'tipos', 'unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = TipoProducto::all();
        $insumos = Insumo::all();
        $unidades = UnidadMedida::all();
        return view('themes.backoffice.pages.producto.create', compact('tipos', 'insumos', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:150',
            'valor' => 'required|integer|max:6',
            'id_tipo_producto' => 'required|integer|exists:tipos_productos,id',
            'insumos.*.id_insumo' => 'required|integer|exists:insumos,id',
            'insumos.*.cantidad_insumo_usar' => 'required|numeric|min:1',
            'insumos.*.id_unidad_medida' => 'required|integer|exists:unidades_medidas,id',
        ], [
            'nombre.required' => 'El campo Nombre es requerido',
            'nombre.max' => 'El nombre excede la cantidad de caracteres permitidos',
            'valor.required' => 'El campo Valor es requerido',
            'id_tipo_producto.required' => 'El campo Tipo Producto es requerido',
            'id_tipo_producto.integer' => 'El campo Tipo Producto debe ser de tipo Numerico',
            'id_tipo_producto.exists' => 'Tipo Producto seleccionado, no existe',
            'insumos.*.id_insumo.required' => 'El insumo es requerido',
            'insumos.*.id_insumo.exists' => 'El insumo seleccionado no existe',
            'insumos.*.cantidad_insumo_usar.required' => 'La cantidad de insumo a usar es requerida',
            'insumos.*.cantidad_insumo_usar.min' => 'La cantidad de insumo a usar minimo debe ser 1',
            'insumos.*.id_unidad_medida.required' => 'La unidad de medida es requerida',
        ]);

        // $producto = Producto::create([
        //     'nombre' => $validatedData['nombre'],
        //     'id_tipo_producto' => $validatedData['id_tipo_producto'],
        // ]);

        $valorProducto = 0;
        $utilidad = 0;

        foreach ($validatedData['insumos'] as $insumoData) {
            // Obtener los insumos con sus datos filtrando por los seleccionados
            $insumo = Insumo::find($insumoData['id_insumo']);
            // Calcular la utilidad del insumo en la cantidad de productos
            $utilidad_producto = $this->calcularUtilidad($insumoData['cantidad_insumo_usar'], $insumoData['id_unidad_medida']);

            // Realizar los cálculos de acuerdo a la unidad de medida
            switch ($insumoData['id_unidad_medida']) {
                case 1: // ID de litros en la unidad de medida
                    $utilidad = 1000 / $insumoData['cantidad_insumo_usar']; // Litros a mililitros
                    break;
                case 2: // ID de kilos en la unidad de medida
                    $utilidad = 1000 / $insumoData['cantidad_insumo_usar']; // Kilos a gramos
                    break;
                default:
                    // Para otras unidades de medida, simplemente retorna la cantidad de insumo
                    $utilidad = $insumoData['cantidad_insumo_usar'];
                    break;
            }

            // Calcular el costo total del insumo en el producto
            $total_costo_producto = $insumo->valor / $utilidad;

            // Redondear el número hacia arriba
            $total_costo_producto = ceil($total_costo_producto);

            // Sumar el costo del insumo al valor total del producto
            $valorProducto += $total_costo_producto;



            // $producto->insumos()->attach($insumoData['id_insumo'], [
            //     'cantidad_insumo_usar' => $insumoData['cantidad_insumo_usar'],
            //     'id_unidad_medida' => $insumoData['id_unidad_medida'],
            //     'total_costo_producto' => intval($total_costo_producto),
            //     'utilidad_producto' => $utilidad_producto,
            // ]);


            dd($total_costo_producto);
        }

    }

    private function calcularUtilidad($cantidad_usar, $unidad_medida_id)
    {

        switch ($unidad_medida_id) {
            case 1: // ID de litros en la unidad de medida
                $cantidad_usar = 1000 / $cantidad_usar;
                return $cantidad_usar; // Convertir a mililitros
            case 2: // ID de kilos en la unidad de medida
                $cantidad_usar = 1000 / $cantidad_usar;
                return $cantidad_usar; // Convertir a gramos

            default:
                return $cantidad_usar; // Si no requiere conversión, devolver la cantidad original
        }
    }

    public function show(Producto $producto)
    {
        //
    }

    public function edit(Producto $producto)
    {
        //
    }

    public function update(Request $request, Producto $producto)
    {
        //
    }

    public function destroy(Producto $producto)
    {
        //
    }
}
