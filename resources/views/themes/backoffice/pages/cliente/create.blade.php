@extends('themes.backoffice.layouts.admin')

@section('tittle','Dar de alta un nuevo usuario')

@section('head')
@endsection

@section('breadcrumbs')
<li><a href="{{route('backoffice.user.index') }}">Nuestros Clientes</a></li>
<li>Crear Usuario</li>
@endsection



@section('content')

<div class="section">
              <p class="caption">Introduce los datos para crear un nuevo cliente</p>
              <div class="divider"></div>
              <div id="basic-form" class="section">
                <div class="row">
                  <div class="col s12 m8 offset-m2 ">
                    <div class="card-panel">
                      <h4 class="header2">Crear Cliente</h4>
                      <div class="row">
                        <form class="col s12" method="post" action="{{route('backoffice.user.store')}}">


                        {{csrf_field() }}
                        <div class="row">
                                <div class="input-field col s12">

                                    

                                </div>
                            </div>     
                            

                            <div class="row">
                                <div class="input-field col s12 m6">
                                <input id="nombre_cliente" type="text" class="form-control @error('nombre_cliente') is-invalid @enderror" name="nombre_cliente" value="{{ old('nombre_cliente') }}" required autocomplete="nombre_cliente" autofocus>
                                    <label for="nombre_cliente">Nombre del cliente</label>

                                    @if($errors->has('nombre_cliente'))
                                        <!-- <div class="alert alert-danger">{{$messages ?? ''}}</div> -->

                                        <span class="invalid-feedback" role="alert">
                                            <strong style="color: red">{{ $errors->first('nombre_cliente') }}</strong>
                                        </span>

                                    @endif

                                    @error('nombre_cliente')
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color:red">{{ $message }}</strong>
                                    </span>
                                @enderror

                                    

                                </div>

                                <div class="input-field col s12 m6">
                                  <input id="correo" type="email" name="correo">
                                  <label for="correo">Correo electrónico</label>
                                    @error('correo')
                                          <span class="invalid-feedback" role="alert">
                                              <strong style="color:red">{{ $message }}</strong>
                                          </span>
                                      @enderror
                                </div>

                            </div>     

                         
                          <div class="row">
                            <div class="input-field col s12 m6">
                              <input id="whatsapp_cliente" type="text" name="whatsapp_cliente" class="form-control @error('nombre_cliente') is-invalid @enderror">
                              <label for="whatsapp_cliente">Whatsapp Cliente</label>
                                @error('whatsapp_cliente')
                                      <span class="invalid-feedback" role="alert">
                                          <strong style="color:red">{{ $message }}</strong>
                                      </span>
                                  @enderror
                            </div>

                            <div class="input-field col s12 m6">
                              <input id="instagram_cliente" type="text" name="instagram_cliente" class="form-control @error('nombre_cliente') is-invalid @enderror">
                              <label for="instagram_cliente">Instagram Cliente</label>
                                @error('instagram_cliente')
                                      <span class="invalid-feedback" role="alert">
                                          <strong style="color:red">{{ $message }}</strong>
                                      </span>
                                  @enderror
                            </div>

                            
                          </div>
                         

                          <div class="row">
                            <div class="input-field col s12 m6">
                              <select>
                                <option value="" disabled selected>-- Seleccione --</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                                <option value="na">Prefiero no responder</option>
                              </select>
                              <label>Género</label>
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
@endsection