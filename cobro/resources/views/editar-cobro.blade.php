@extends('master')

@if ($exito==1)
  <div style="padding:15px; background:#FF8000;">
    <h1>MODIFICADO CON EXITO</h1>
  </div>
@endif
@section('cuerpo')
  <h1>MODIFIQUE LOS DATOS DEL COBRO Y PRESIONE EN GUARDAR</h1>
  <div class="table-responsive">
    <table class="table">
      <tr>
        <tr>
          <th>Numero Alumno</th>
          <th>Numero Operacion</th>
          <th>Cantidad cuotas</th>
          <th>Monto</th>
          <th>Cuenta</th>
          <th>Fecha</th>
        </tr>
      </tr>
      <tr>
        <form class="" action="/editar-cobro/{{$cobro['id']}}" method="get">
          <td><input type="text" name="id" value="{{$cobro['id']}}" size="10"></td>
          <td><input type="text" name="numero_operacion" value="{{$cobro['numero_operacion']}}" size="10"></td>
          <td><input type="text" name="cant_cuotas" value="{{$cobro['cant_cuotas']}}" size="10"></td>
          <td><input type="text" name="monto" value="{{$cobro['monto']}}" size="10"></td>
          <td><input type="text" name="cuenta" value="{{$cobro['cuenta']}}" size="10"></td>
          <td><input type="text" name="fecha" value="{{$cobro['fecha']}}" size="6"></td>
      </tr>
      <tr>
        <td><input type="submit" name="" value="GUARDAR"></td>
      </tr>
    </form>
    </table>

  </div>
@endsection
