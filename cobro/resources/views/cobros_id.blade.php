@extends('master')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


<script>

$(document).ready(function(){
  $('#panel').hide();
  $('#actualizar-cupo').click(function(){
    $('#panel').slideToggle();
  });
});


function wea(valor) {
  if (valor=="") {
    document.getElementById('montoo').value = "";
  }
  else {
    document.getElementById('montoo').value = {{$estado['valor_cuota']}}*valor;
  }
}
</script>

@section('cuerpo')
  <div class="form-group">
  <table>
    <tr>
      <th>Numero Alumno</th>
      <th>Nombre</th>
      <th>DNI</th>
      <th>Datos Tarjeta</th>
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
<div class="form-group">
  <table>
    <tr>
      <th>Valor Restante</th>
    </tr>
    <tr>
      <td>{{$estado['valor_restante']}}</td>
    </tr>
  </table>
</div>
  <table>
    <tr>
      <th>Cupo</th>
      <th>Fecha actualizacion</th>
    </tr>
    <tr>
      @if ($cupo != null)
        <td>{{$cupo['tiene']}}</td>
        <td>{{$cupo['updated_at']}}</td>
      @else
        <td>Sin Actualizar</td>
        <td>Sin Actualizar</td>
      @endif
    </tr>
  </table>
  <p>Si se pone <strong>"Total"</strong>  ya se toma como el curso completamente pagado.</p>
  <p>En caso de ser una recurrencia colocar siempre parcial</p>
  <div class="row">
    <div class="col">
      <h2>Historial de cobros</h2>
      <div class="table-responsive">
        <table class="table ">
            <tr>
              <th>Numero Operacion</th>
              <th>Tipo</th>
              <th>Cantidad Cuotas</th>
              <th>Monto</th>
              <th>Cuenta</th>
              <th>Fecha</th>
            </tr>
            @foreach ($cobros as $cobro)
              <tr>
                <td>{{$cobro['numero_operacion']}}</td>
                <td>{{$cobro['tipo']}}</td>
                <td>{{$cobro['cant_cuotas']}}</td>
                <td>{{$cobro['monto']}}</td>
                <td>{{$cobro['cuenta']}}</td>
                <td>{{$cobro['fecha']}}</td>
              </tr>
            @endforeach
        </table>
      </div>
    </div>
  </div>
  @section('formulario')
    <div class="form-group">

      <div class="d-flex justify-content-center" >
        <form action="/cargar/{{$dato['id']}}" method="get">
          <div>
            <input type="text" name="numero_operacion" value="" placeholder="Numero Operacion" required><br>
            <select class="" name="tipo">
              <option value="total">Total</option>
              <option value="parcial">Parcial</option>
            </select><br>
            <select class="" name="cantidad" onchange="wea(this.value)">
              <option value="">Seleccione opcion...</option>
              @for ($i=1; $i < 13; $i++)
                <option value="{{$i}}">{{$i}} Cuotas</option>
              @endfor
              <option value="oro">Naranja Oro</option>
            </select><br>
            <select class="" name="cuenta">
              <option value="matias">Matias</option>
              <option value="MP Seba">MP Seba</option>
              <option value="leo">Leo</option>
              <option value="comate">COMATE</option>
            </select><br>
            <input type="number" name="monto" id="montoo" value="" placeholder="Monto" required><br>
            <input type="text" name="fecha" value="{{$fecha}}" required><br>
            <input type="submit" class="boton" name="enviar" value="CARGAR">
          </div>
        </form>
      </div>
    </div>

<div class="row">
  <div class="d-flex justify-content-center">
    <div class="form-group">
      <form class="" action="{{route('cargarComentario',['id' => $dato['id']])}}" method="post">
        @csrf
        <textarea id="comentario" name="comentario" rows="3" cols="70" placeholder="Ingresa un comentario..." required></textarea><br>
        <input type="submit" class="btn btn-primary" name="boton" value="Cargar">
      </form>
    </div>

  </div>
      <div class="form-block">
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
@endsection
