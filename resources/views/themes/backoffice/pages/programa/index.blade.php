@extends('themes.backoffice.layouts.admin')

@section('tittle','Programas Botacura')

@section('head')
@endsection

@section('breadcrumbs')
@endsection


@section('dropdown_settings')
@endsection

@section('content')
<div class="section">
              <p class="caption"><strong>Programas de Temporada</strong></p>
              <div class="divider"></div>
              <div id="basic-form" class="section">
                <div class="row">
                  <div class="col s12 ">
                    <div class="card-panel">
                     
                      <div class="row">


                      <table>
                            <thead>
                                <tr>
                                    <th>Nombre Programa	</th>
                                    <th>Valor Programa</th>
                                    <th>Descuento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($programa as $programa)
                                <tr>
                                    <td><a href="{{route ('backoffice.programa.show',$programa)}}">{{$programa->nombre_programa}}</a></td>
                                    <td>{{$programa->valor_programa}}</td>
                                    <td>{{$programa->descuento}}</td>
                                    <td><a href="{{route ('backoffice.programa.edit',$programa)}}">Editar</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                    </table>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
</div>
@endsection


@section('foot')
@endsection
