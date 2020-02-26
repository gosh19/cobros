@extends('master')

@if ($exito ==1)
  <div class="alerta" style="padding:15px; background:#8A0808; color: #FFF; ">
    <h2>MODIFICADO CON EXITO</h2>
  </div>

@endif
@section('cuerpo')
  <h1>MODIFIQUE EL CAMPO QUE NECESITE</h1>
  <ul>
    <li><h3>Al presionar "guardar" los datos se sobreescribiran</h3></li>
    <li><h3>Si presiona eliminar se borrrara al alumno de la base</h3></li>
    <li><h4>Si dejas la parte de titular vacia se guarda automaticamente los datos del inscripto</h4></li>
  </ul>

    <form class="" action="/editar/{{$dato['id']}}" method="get">
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>Numero Alumno</th>
            <th>Nombre</th>
            <th>DNI</th>
            <th>E-mail</th>
            <th>Tarjeta</th>
          </tr>
          <tr>
            <td><p>{{$dato['id']}}</p></td>
            <td><input type="text" name="nombre" value="{{$dato['nombre']}}" size="15"></td>
            <td><input type="text" name="dni" value="{{$dato['dni']}}" size="12"></td>
            <td><input type="text" name="mail" value="{{$dato['mail']}}" size="12"></td>
            <td><input type="text" name="tarjeta" value="{{$dato['tarjeta']}}"></td>
          </tr>
          <tr>
            <td><strong>TITULAR</strong></td>
            <td><input type="text" name="nombre-titular" value="{{$titular['nombre']}}" size="15"></td>
            <td><input type="text" name="dni-titular" value="{{$titular['dni']}}" size="12"></td>
          </tr>
        </table>
      </div>
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>Numero Alumno</th>
            <th>Tipo</th>
            <th>Valor cuota</th>
            <th>Cuotas pagas</th>
            <th>Valor Restante</th>
            <th>Fecha sig. cobro</th>
            <th>Cantidad anexos</th>
          </tr>
          <tr>
            <td>{{$estado['id']}}</td>
            <td><input type="text" name="tipo" value="{{$estado['tipo']}}" size="5"></td>
            <td><input type="text" name="valor_cuota" value="{{$estado['valor_cuota']}}" size="5"></td>
            <td><input type="text" name="cuotas_pagas" value="{{$estado['cuotas_pagas']}}" size="5"></td>
            <td><input type="text" name="valor_restante" value="{{$estado['valor_restante']}}" size="5"></td>
            <td><input type="text" name="fecha_siguiente_cobro" value="{{$estado['fecha_siguiente_cobro']}}" size="5"></td>
            <td><input type="text" name="anexos" value="{{$estado['anexos']}}" size="5"></td>
          </tr>
        </table>
        <input type="submit" name="boton" value="Guardar">
      </div>
    </form>
    <div class="text-center" style="background: #FFF; padding:15px; font-weight:bold;">
      <a href="/borrar/{{$dato['id']}}">ELIMINAR</a>
    </div>
@endsection
