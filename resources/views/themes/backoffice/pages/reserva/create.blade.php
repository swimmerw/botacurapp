@extends('themes.backoffice.layouts.admin')

@section('title','Crear reserva')

@section('head')
@endsection

@section('breadcrumbs')
<li><a href="{{route('backoffice.cliente.show', $cliente->id) }}">Reservas del cliente</a></li>
<li>Crear Reserva</li>
@endsection



@section('content')

<div class="section">
  <p class="caption">Introduce los datos para crear un nuevo reserva</p>
  <div class="divider"></div>
  <div id="basic-form" class="section">
    <div class="row">
      <div class="col s12 m8 offset-m2 ">
        <div class="card-panel">
          <h4 class="header">Crear reserva para <strong>{{$cliente->nombre_cliente}}</strong></h4>
          <div class="row">
            <form class="col s12" method="post" enctype="multipart/form-data" action="{{route('backoffice.reserva.store')}}">


              {{csrf_field() }}



              <div class="row">
                <div class="input-field col s12 m6 l4">

                  <select name="id_programa" id="id_programa">
                    <option value="" disabled selected>-- Seleccione un programa --</option>
                    @foreach ($programas as $programa)
                    <option value="{{$programa->id}}" @if (old('id_programa') == $programa->id)
                      selected
                    @else
                      
                    @endif data-valor="{{$programa->valor_programa}}">{{$programa->nombre_programa}}</option>
                    @endforeach
                  </select>
                  <label for="id_programa">Programa</label>
                  @error('id_programa')
                  <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                


                <div class="input-field col s12 m6 l4">
                  <input id="cliente_id" type="hidden" class="form-control" name="cliente_id" value="{{$cliente->id}}"
                    required>


                  <label for="cantidad_personas">Cantidad Personas</label>

                  <input id="cantidad_personas" type="number"
                    class="form-control @error('cantidad_personas') is-invalid @enderror" name="cantidad_personas"
                    value="{{old('cantidad_personas')}}" required>
                  @error('cantidad_personas')
                  <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $message }}</strong>
                  </span>
                  @enderror

                </div>

                <div class="input-field col s12 m6 l4">
                  <input id="cantidad_masajes" type="number" name="cantidad_masajes"
                    value="{{ old('cantidad_masajes') }}">
                  <label for="cantidad_masajes">Cantidad Masajes</label>
                  @error('cantidad_masajes')
                  <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

              </div>

              <div class="row">

                <div class="input-field col s12 m3">

                  <label for="abono_programa">Cantidad de Abono</label>
                  <input id="abono_programa" type="text" name="abono_programa" class=""
                    value="{{ old('abono_programa') }}">
                  @error('abono_programa')
                  <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $message }}</strong>
                  </span>
                  @enderror

                </div>

                <div class="file-field input-field col s12 m5">
                  <div class="btn">
                    <span>Imagen Abono</span>
                    <input type="file" id="imagen_abono" name="imagen_abono">
                  </div>
                  <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Seleccione su archivo">
                  </div>
                  @error('imagen_abono')
                  <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $message }}</strong>
                  </span>
                  @enderror
                </div>


                <div class="input-field col s12 m4">
                  <select name="id_tipo_transaccion_abono" id="id_tipo_transaccion_abono">
                    <option value="" disabled selected>-- Seleccione --</option>
                    @foreach ($tipos as $tipo)
                    <option value="{{$tipo->id}}" @if (old('id_tipo_transaccion_abono') == $tipo->id)
                      selected
                    @else
                      
                    @endif
                    >{{$tipo->nombre}}</option>
                    @endforeach
                  </select>
                  <label for="id_tipo_transaccion_abono">Tipo Transaccion Abono</label>
                </div>
              </div>



              <div class="row">
                {{-- <label for="fecha_visita">Fecha Visita</label> --}}
                <p>Fecha Visita: </p>
                <div class="input-field col s12 m6">
                  <input id="fecha_visita" type="date" name="fecha_visita" class="" value="{{ old('fecha_visita') }}"
                    placeholder="fecha Visita">
                  @error('fecha_visita')
                  <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="input-field col s12 m6">
                  <input id="observacion" name="observacion" type="text" class="" value="{{ old('observacion') }}" />
                  <label for="observacion">Observaciones</label>
                  @error('observacion')
                  <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $message }}</strong>
                  </span>
                  @enderror
                </div>


              </div>

              <div class="row">
                <div class="input-field col s12 m3">

                  <label for="total_pagar">Total a pagar</label>
                  <input id="total_pagar" type="number" name="total_pagar" class="" value="{{old('total_pagar')}}"
                    placeholder="0" readonly>
                  @error('total_pagar')
                  <span class="invalid-feedback" role="alert">
                    <strong style="color:red">{{ $message }}</strong>
                  </span>
                  @enderror

                </div>

                <div class="input-field col s12 m6">
                  <label for="imagenSeleccionadaAbono">Imagen Abono:</label>
                  <img class="center-text" id="imagenSeleccionadaAbono" src="https://via.placeholder.com/200x300" alt=""
                    style="max-height: 200px">
                </div>
              </div>








              <div class="row">
                <div class="input-field col s12">
                  <button class="btn waves-effect waves-light right" type="submit">Guardar
                    <i class="material-icons right">send</i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection


@section('foot')
<script>
  $(document).ready(function (e) {   
  $('#imagen_abono').change(function(){            
      let reader = new FileReader();
      reader.onload = (e) => { 
          $('#imagenSeleccionadaAbono').attr('src', e.target.result); 
      }
      reader.readAsDataURL(this.files[0]);
  });
});


$(document).ready(function (e) {   
  $('#imagen_diferencia').change(function(){            
      let reader = new FileReader();
      reader.onload = (e) => { 
          $('#imagenSeleccionadaDiferencia').attr('src', e.target.result); 
      }
      reader.readAsDataURL(this.files[0]);
  });
});
</script>

<script>
  var valorPrograma = 0;
  var cantidadPersonas = 1;
  var abono = 0;

$('#id_programa').on('change', function(){
  valorPrograma = $(this).find(':selected').data('valor');
  calcularValorTotal();
});

$('#cantidad_personas').on('change', function(){
  cantidadPersonas = $(this).val();
  calcularValorTotal();
})

$('#abono_programa').on('change', function(){
  abono = $(this).val();
  calcularValorTotal();
})

function calcularValorTotal(){

  var total = (valorPrograma * cantidadPersonas)-abono;
  $('#total_pagar').val(total);
}

</script>
@endsection