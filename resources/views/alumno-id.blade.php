@extends('master')

@section('cuerpo')
  <div class="row">
    <div class="col">
      <div class="card">
        <div class="card-header"><strong>Datos</strong></div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>ID: </strong>{{$dato['id']}}</li>
          <li class="list-group-item"><strong>Nombre: </strong>{{$dato['nombre']}}</li>
          <li class="list-group-item"><strong>DNI: </strong>{{$dato['dni']}}</li>
          <li class="list-group-item"><strong>E-mail: </strong>{{$dato['mail']}}</li>
          <li class="list-group-item"><strong>Telefono: </strong>{{$dato['telefono']}}</li>
          <li class="list-group-item"><strong>Datos TC: </strong>{{$dato['tarjeta']}}</li>
          <li class="list-group-item"><strong>Tipo: </strong>{{$dato['tipo_tarjeta']}}</li>
        </ul>
      </div><br>
      <a href="/baja/{{$dato['id']}}">
        @if (($baja == null) || ($baja['estado'] == 1 ))
          <div id="baja" class="text-center">Dar Baja</div>
        @else
          <div id="baja" class="text-center">Dar Alta</div>
        @endif
      </a>
      <a href="#">
        <div id="devolucion" onclick="devolucion()" class="text-center">Devolucion</div>
      </a>
      <a href="/cargar-factura/{{$dato['id']}}">
        <div id="devolucion" class="text-center">Cargar factura</div>
      </a>
      <div class="form-group">
        <form class="" action="{{route('cargarComentario',['id' => $dato['id']])}}" method="post">
          @csrf
          <textarea id="comentario" name="comentario" rows="3" cols="70" placeholder="Ingresa un comentario..." required></textarea><br>
          <input type="submit" class="btn btn-primary" name="" value="Cargar">
        </form>
      </div>
    </div>
    <div class="col">
      <div class="table-responsive">
        <h3>Lista de cobros</h3>
        <table class="table">
          <tr>
            <th>Numero operacion</th>
            <th>Tipo</th>
            <th>Cantidad cuotas</th>
            <th>Monto</th>
            <th>Cuenta</th>
            <th>Fecha</th>
          </tr>
          @php
            $total=0;
          @endphp
          @foreach ($cobros as $cobro)
            <tr>
              <td>{{$cobro['numero_operacion']}}</td>
              <td>{{$cobro['tipo']}}</td>
              <td>{{$cobro['cant_cuotas']}}</td>
              <td>{{$cobro['monto']}}</td>
              <td>{{$cobro['cuenta']}}</td>
              <td>{{$cobro['fecha']}}</td>
            </tr>
            @php
              $total = $total + $cobro['monto'];
            @endphp
          @endforeach
        </table>
      </div>
      <div class="card">
        <div class="card-header">
          <strong>Dinero Cobrado</strong>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">${{$total}}</li>
        </ul>
        <div class="card-header">
          <strong>Dinero por Cobrar</strong>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">${{$estado['valor_restante']}}</li>
          <li class="list-group-item"><strong>Fecha a cobrar: </strong>
            @if ($estado['fecha_siguiente_cobro']=="1000-01-01")
              No cobrar mas pu
            @else
              {{$estado['fecha_siguiente_cobro']}}
            @endif
            </li>
        </ul>
      </div>
      <a href="/editar/{{$dato['id']}}">
        <div class="boton text-center">Editar</div>
      </a>
    </div>
    <div id="wea">

    </div>
    
  </div>
  <div class="row">
    <div class="col">
      <div class="table">
        <table class="table-responsive">
          <tr>
            <th>Comentario</th>
            <th>Fecha</th>
          </tr>
          @foreach ($comentarios as $comentario)
            <tr>
              <td>{{$comentario['comentario']}}</td>
              <td>{{$comentario['created_at']}}</td>
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
@endsection
