@extends('master')

<script>
function wea(valor) {
  if (valor=="") {
    document.getElementById('montoo').value = "";
  }
  else {
    document.getElementById('montoo').value = {{$cuota}}*valor;
  }
}
</script>
@section('cuerpo')
  <h1>Datos Alumno</h1>
  <div class="table-responsive">
    <table class="table">
      <tr>
        <th>Numero Alumno</th>
        <th>Nombre</th>
        <th>dni</th>
        <th>Tarjeta</th>
      </tr>
      <tr>
        <td>{{$dato['id']}}</td>
        <td>{{$dato['nombre']}}</td>
        <td>{{$dato['dni']}}</td>
        <td>{{$dato['tarjeta']}}</td>
      </tr>
      @if ($titular['id']!=null)
        <tr>
          <td><strong>TITULAR</strong></td>
          <td>{{$titular['nombre']}}</td>
          <td>{{$titular['dni']}}</td>
        </tr>
      @endif
    </table>
  </div>
@endsection
@section('formulario')
  <h1 class="text-center">Ingrese los datos del cobro</h1>
  <div class="d-flex justify-content-center">
    <form class="" action="/cargar/{{$id}}" method="get">
      <input type="text" name="numero_operacion" value="" placeholder="numero_operacion" required><br>
      <select class="" name="tipo">
        <option value="total">Total</option>
        <option value="parcial">Parcial</option>
      </select><br>
      <select class="" name="cantidad" onchange="wea(this.value)">
        <option value="">Seleccione opcion...</option>
        @for ($i=1; $i < 13; $i++)
          <option value="{{$i}}">{{$i}} Cuotas</option>
        @endfor
      </select><br>
      <select class="" name="cuenta">
        <option value="matias">Matias</option>
        <option value="MP Seba">MP cboya</option>
        <option value="leo">Leo</option>
        <option value="comate">COMATE</option>
        <option value="efectivo">Efectivo</option>
      </select><br>
      $<input type="number" id="montoo" name="monto"  value="0" placeholder="Ingrese valor a cobrar..." required><br>
      <input type="text" name="fecha" placeholder="Fecha" value="{{$fecha}}"><br>
      <input class="boton" type="submit" name="Enviar" value="Cargar">
    </form>
  </div>
@endsection
