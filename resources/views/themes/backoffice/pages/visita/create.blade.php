@extends('themes.backoffice.layouts.admin')

@section('title','Planificar Visita')

@section('head')
@endsection

@section('breadcrumbs')
<li><a href="{{route('backoffice.reserva.show', $reserva) }}">Reagendamiento para reserva del cliente</a></li>
<li>Planificar Visita</li>
@endsection



@section('content')

<div class="section">
    <p class="caption">Introduce los datos para planificar una Visita</p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12 m8 offset-m2 ">
                <div class="card-panel">
                    <h4 class="header">Planificar visita para <strong>{{$reserva->cliente->nombre_cliente}}</strong> -
                        Fecha:<strong>{{$reserva->fecha_visita}}</strong></h4>
                    <div class="row">
                        <form class="col s12" method="post"
                            action="{{route('backoffice.reserva.visitas.store', $reserva)}}">


                            {{csrf_field() }}



                            <div class="row">
                                <div class="input-field col s12 m6 l4" hidden>
                                    <input id="id_reserva" type="hidden" class="form-control" name="id_reserva"
                                        value="{{$reserva->id}}" required>
                                </div>
                                <div class="input-field col s12 m6 l4" @if(!in_array('Sauna', $servicios)) hidden @endif>

                                    <label for="horario_sauna">Horario Sauna</label>
                                    <input id="horario_sauna" type="text" name="horario_sauna" class="timepicker"
                                        value="{{ old('horario_sauna') }}" placeholder="" @if(!in_array('Sauna', $servicios)) disabled hidden @endif>
                                    @error('horario_sauna')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l4" @if(!in_array('Tinaja', $servicios)) hidden @endif>

                                    <label for="horario_tinaja">Horario Tinaja</label>
                                    <input id="horario_tinaja" type="text" name="horario_tinaja" class="timepicker"
                                        value="{{ old('horario_tinaja') }}" placeholder="" @if(!in_array('Tinaja', $servicios)) disabled hidden @endif>
                                    @error('horario_tinaja')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-field col s12 m6 l4" @if(!in_array('Masaje', $servicios)) hidden @endif>

                                    <label for="horario_masaje">Horario Masaje</label>
                                    <input id="horario_masaje" type="text" name="horario_masaje" class="timepicker"
                                        value="{{ old('horario_masaje') }}" placeholder="" @if(!in_array('Masaje', $servicios)) disabled hidden @endif>
                                    @error('horario_masaje')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>



                                <div class="input-field col s12 m6 l4">

                                    <label for="alergias">Alérgias</label>
                                    <input id="alergias" type="text" name="alergias" class=""
                                        value="{{ old('alergias') }}">
                                    @error('alergias')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l4">

                                    <label for="observacion">Observaciones</label>
                                    <input id="observacion" type="text" name="observacion" class=""
                                        value="{{ old('observacion') }}">
                                    @error('observacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>


                                <div class="input-field col s12 m6 l4">
                                    <select name="id_ubicacion" id="id_ubicacion">
                                        <option value="" selected disabled="">-- Seleccione --</option>
                                        @foreach ($ubicaciones as $ubicacion)
                                        <option value="{{$ubicacion->id}}" {{ old('id_ubicacion')==$ubicacion->nombre ?
                                            'selected' : '' }}>{{$ubicacion->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_ubicacion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="id_ubicacion">Ubicación</label>
                                </div>
                                <div class="input-field col s12 m6 l4">
                                    <select name="id_lugar_masaje" id="id_lugar_masaje">
                                        <option value="" selected disabled="">-- Seleccione --</option>
                                        @foreach ($lugares as $lugar)
                                        <option value="{{$lugar->id}}" {{ old('id_lugar_masaje')==$lugar->nombre ?
                                            'selected' : '' }}>{{$lugar->nombre}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_lugar_masaje')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label for="id_lugar_masaje">Lugar Masaje</label>
                                </div>




                                <div class="col s12 m6 l4">
                                    <label for="trago_cortesia">Trago cortesia</label>
                                    <p>
                                        <label>
                                            <input name="trago_cortesia" id="trago_cortesia" type="radio" class="with-gap" value="Si" />
                                            <span>Si</span>
                                        </label>
                                    
                                        <label>
                                            <input name="trago_cortesia" id="trago_cortesia" type="radio" class="with-gap" value="No" checked/>
                                            <span>No</span>
                                        </label>
                                    </p>
                                    {{-- <select name="trago_cortesia" id="trago_cortesia">
                                        <option value="Si">Si</option>
                                        <option value="No" selected>No</option>
                                    </select> --}}

                                    @error('trago_cortesia')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    
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
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.timepicker');
    var instances = M.Timepicker.init(elems);
  });
</script>

@endsection