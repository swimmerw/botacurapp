@extends('themes.backoffice.layouts.admin')

@section('title','Crear Servicio')

@section('head')
@endsection

@section('breadcrumbs')
<li>Crear Servicios</li>
@endsection


@section('dropdown_settings')
@endsection

@section('content')

<div class="section">
              <p class="caption">Introduce los datos para crear un nuevo Servicio</p>
              <div class="divider"></div>
              <div id="basic-form" class="section">
                <div class="row">
                  <div class="col s12 m8 offset-m2 ">
                    <div class="card-panel">
                      <h4 class="header2">Crear Servicio</h4>
                      <div class="row">
                        <form class="col s12" method="post" action="{{route('backoffice.servicio.store')}}">


                        {{csrf_field() }}
                          <div class="row">
                            <div class="input-field col s12">
                              <input id="nombre_servicio" type="text" name="nombre_servicio">
                              <label for="nombre_servicio">Nombre del Servicio</label>
                                @error('nombre_servicio')
                                      <span class="invalid-feedback" role="alert">
                                          <strong style="color:red">{{ $message }}</strong>
                                      </span>
                                  @enderror


                            </div>
                          </div>
                         
                          <div class="row">
                            <div class="input-field col s12">
                              <input id="valor_servicio" class="materialize-textarea" name="valor_servicio"></textarea>
                              <label for="valor_servicio">Valor Programa</label>

                              @error('valor_servicio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            </div>

                            <div class="row">
                            <div class="input-field col s12">
                              <input id="descuento" class="materialize-textarea" name="descuento"></textarea>
                              <label for="descuento">Descuento</label>

                              @error('descuento')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="row">
                              <div class="input-field col s12">
                                <button class="btn waves-effect waves-light right" type="submit">Guardar
                                  <i class="material-icons right">send</i>
                                </button>
                              </div>
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
@endsection
