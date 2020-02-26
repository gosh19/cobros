<script>
  function filtroope(str) {
      if (str == "") {
          document.getElementById("txtHint").innerHTML = "";
          return;
      } else {
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("tablaBuscador").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET","buscador-cobro.php?criterio=numero_operacion&&q="+str,true);
          xmlhttp.send();
      }
  }
  function filtroid(str) {
      if (str == "") {
          document.getElementById("txtHint").innerHTML = "";
          return;
      } else {
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("tablaBuscador").innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET","buscador-cobro.php?criterio=id&&q="+str,true);
          xmlhttp.send();
      }
  }

</script>


@extends('master')

@if (session('alerta')=="exito")
  <div class="exito">
    <h2>Cargado con exito</h2>
  </div>
@endif

@section('cuerpo')
  <input type="text" onkeyup="filtroid(this.value)" placeholder="Busqueda por numero de alumno..." size="40">
  <input type="text" onkeyup="filtroope(this.value)" placeholder="Busqueda por numero de Operacion..." size="40">

  <div id="tablaBuscador">

  </div>
  @if (@$estados!=null)

    <div class="table-responsive">
      <table class="table">
        <tr>
          <th>xd</th>
          <th>Numero Alumno</th>
          <th>Tipo</th>
          <th>Valor Cuota</th>
          <th>Cuotas Pagas</th>
          <th>Valor restante</th>
          <th>Fecha</th>
          <th>Anexos</th>
          <th>EDITAR</th>
        </tr>
        @foreach ($estados as $estado)
          <tr>
            <td>{{@$estado['indice']}}</td>
            <td>{{@$estado['id']}}</td>
            <td>{{@$estado['tipo']}}</td>
            @foreach ($datos as $dato)
              @if (@$dato['id']==@$estado['id'])
                <td>{{$dato['dni']}}</td>
              @endif
            @endforeach
            <td>{{@$estado['valor_cuota']}}</td>
            <td>{{@$estado['cuotas_pagas']}}</td>
            <td>{{@$estado['valor_restante']}}</td>
            <td>{{@$estado['fecha_siguiente_cobro']}}</td>
            <td>{{@$estado['anexos']}}</td>
            <td><a href="/editar-cobro/{{$estado['id']}}">EDITAR</a></td>
          </tr>
        @endforeach
      </table>
    </div>

  @else
    @if (@$cobros!=null)
      <div class="table-responsive">
        <table class="table">
          <tr>
            <th>Numero Alumno</th>
            <th>Numero operacion</th>
            <th>DNI</th>
            <th>Tipo</th>
            <th>Cantidad cuotas</th>
            <th>Monto</th>
            <th>Cuenta</th>
            <th>Fecha</th>
            <th>EDITAR</th>
          </tr>
          @foreach ($cobros as $cobro)
            <tr>
              <td>{{$cobro['id']}}</td>
              <td>{{$cobro['numero_operacion']}}</td>
              @foreach ($datos as $dato)
                @if ($dato['id']==$cobro['id'])
                  <td>{{$dato['dni']}}</td>
                @endif
              @endforeach
              <td>{{$cobro['tipo']}}</td>
              <td>{{$cobro['cant_cuotas']}}</td>
              <td>{{$cobro['monto']}}</td>
              <td>{{$cobro['cuenta']}}</td>
              <td>{{$cobro['fecha']}}</td>
              <td><a href="/editar-cobro/{{$cobro['id']}}">EDITAR</a></td>
            </tr>
          @endforeach
        </table>
      </div>
    @else
      <div class="">
        <h1 class="text-center">ERROR</h1>
      </div>
    @endif
  @endif
@endsection
