@extends('themes.backoffice.layouts.admin')

@section('title','Programas Botacura')

@section('head')
@endsection

@section('breadcrumbs')
@endsection


@section('dropdown_settings')
@endsection

@section('content')
<div class="section">
              <p class="caption"><strong>Programa: </strong>{{$programa->nombre_programa}}</p>
              <div class="divider"></div>
              <div id="basic-form" class="section">
                <div class="row">
                  <div class="col s12 m8 offset-m2 ">
                    <div class="card-panel">
                      <h4 class="header2">Servicios del programa <strong>{{$programa->nombre_programa}}</strong></h4>
                      <div><p><strong>Valor: </strong>{{$programa->valor_programa}}</p></div>
                      <div class="row">
                        <ul>

                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
</div>
@endsection


@section('foot')
@endsection
