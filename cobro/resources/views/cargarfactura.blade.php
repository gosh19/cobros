@extends('master')



@section('formulario')
  <h2>Carga de fatura para {{$dato['nombre']}}</h2>
  <form class="" action="/factura" method="get">
    <input type="text" name="numero_factura" value="" placeholder="Numero Fatura">
    <input type="text" name="provincia" value="" placeholder="Provincia">
    <input type="submit" name="" value="Cargar">
  </form>
@endsection
