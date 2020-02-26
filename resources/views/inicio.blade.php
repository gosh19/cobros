@extends('master')

@section('cuerpo')

@if (@$alerta=="cargado")
  <div class="container">
    <div class="alerta">
      <h1>CARGADO CON EXITO CBOYA ;)</h1>
    </div>
  </div>
@else
  @if (@$alerta=="completado")
    <div class="container">
        <h1>YA PAGO 12</h1>
    </div>
  @else
    @if (@$alerta=="borrado")
      <div class="container">
        <h1>BORRADO CON EXITO</h1>
      </div>
    @else
      @if (@$alerta=="baja")
        <div class="container">
          <h1>DADO DE BAJA CON EXITO</h1>
        </div>
      @endif
    @endif
  @endif
@endif



  <div class="container">
    <h3 class="text-center" style="padding:30px; color:#D8D8D8;">En memoria del Pupy Wacz</h3><br> 
    <h1 class="text-center" style="padding:30px; color:#FFF;">¿Que quieres hacer?</h1>
    <div class="row">
      <div class="col">
        <a href="/">
          <div class="caja text-center">
              INICIO
          </div>
        </a>
        <div class="franja"></div>
      </div>
      <div class="col">
        <a href="/cargaralumno">
          <div class="caja text-center">
              CARGAR ALUMNO
          </div>
        </a>
        <div class="franja"></div>
      </div>
      <div class="col">
        <a href="/cobrosdia">
          <div class="caja text-center">
              COBROS DEL DIA
          </div>
        </a>
        <div class="franja"></div>
      </div>
      <div class="col">
        <a href="/verhistorial">
          <div class="caja text-center">
              VER HISTORIAL
          </div>
        </a>
        <div class="franja"></div>
      </div>
    </div>
  </div>

@endsection
