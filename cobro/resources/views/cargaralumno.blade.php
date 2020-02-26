@extends('master')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

@if (session('alert'))

    <script>
        alert("ID YA EXISTENTE");
    </script>
  
@endif

<script type="text/javascript">

  $(document).ready(function(){
    $("#panel").hide();

    $("#no-titular").click(function(){
      $("#panel").slideToggle();
    });

    
});

</script>

@section('formulario')

  <h1 class="text-center">Ingrese los datos del alumno</h1>
  <div class="d-flex justify-content-center">
    <form class="" action="/cargarcobro" method="get">
      <input type="number" name="id" value="" placeholder="Numero de alumno" required><br>
      <input type="text" name="nombre" value="" placeholder="Nombre completo" required><br>
      <input type="text" name="dni" value="" placeholder="DNI" required><br>
      <input type="text" name="mail" value="" placeholder="E-mail" required><br>
      <input type="text" name="tarjeta" value="" placeholder="Datos Tarjeta" required><br>
      <input type="number" name="valor_cuota" value="" placeholder="Valor cuota"><br>
      <input type="number" name="anexos" value="" placeholder="Anexos"><br>
      <select class="tipo" name="tipo">
        <option value="">Tipo de pago...</option>
        <option value="credito">Credito</option>
        <option value="debito">Debito</option>
        <option value="efectivo">Efectivo</option>
      </select><br>
      <div id="credito" style="width:100%; background:#2E9AFE; padding:10px; border-radius:10px;">
        <select class="" name="cant_cuotas">
            <option value="6">6 Cuotas</option> 
          @for ($i=12; $i > 0; $i--)
            <option value="{{$i}}">{{$i}} Cuota(s)</option>
          @endfor
        </select>
      </div>
      <div id="no-titular">
        <h4 class="text-center">No es titular</h4>
      </div>
      <div class="no-titular" id="panel">
        <input type="text" name="nombre-titular" value="" placeholder="Nombre titular"><br>
        <input type="text" name="dni-titular" value="" placeholder="DNI titular"><br>
      </div>
      <input type="text" name="fecha_siguiente_cobro" value="{{$fecha}}" required><br>
      <input class="boton" type="submit" name="Enviar" value="Cargar alumno">
    </form>
  </div>

@endsection
