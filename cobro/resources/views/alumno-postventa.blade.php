@extends('master')

@section('cuerpo')
  <div class="row">
    <div class="col-2-md">
      <h1>{{$dato['id']}}</h1>
    </div>
    <div class="col-md">
      <div class="card">
        <div class="card-header">
          <strong>Datos</strong>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><strong>ID: </strong>{{$dato['id']}}</li>
          <li class="list-group-item"><strong>Nombre: </strong>{{$dato['nombre']}}</li>
          <li class="list-group-item"><strong>DNI: </strong>{{$dato['dni']}}</li>
          <li class="list-group-item"><strong>E-mail: </strong>{{$dato['mail']}}</li>
          <li class="list-group-item"><strong>Telefono: </strong>{{$dato['telefono']}}</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row">
    <h1>Contactos</h1>
    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>Fecha</th>
          <th>Tipo</th>
          <th>Comentario</th>
        </tr>
      </table>
    </div>
  </div>
@endsection
