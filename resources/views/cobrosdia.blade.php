@extends('master')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
  function filtromes(str) {
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
          xmlhttp.open("GET","buscador-estados.php?criterio=fecha_siguiente_cobro&&q="+str,true);
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
          xmlhttp.open("GET","buscador-estados.php?criterio=id&&q="+str,true);
          xmlhttp.send();
      }
  }
  function actualizarCupo(id){
      if (id != "") {
      
          if (window.XMLHttpRequest) {
              // code for IE7+, Firefox, Chrome, Opera, Safari
              xmlhttp = new XMLHttpRequest();
          } else {
              // code for IE6, IE5
              xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                  document.getElementById("cupo"+id).innerHTML = this.responseText;
              }
          };
          xmlhttp.open("GET","actualizar-cupo.php?q="+id,true);
          xmlhttp.send();
      }
  }
  $(document).ready(function(){
    $("#panel").hide();
    $("#pu").click(function(){
        $("#panel").slideToggle("slow");
    });
});
</script>

@section('cuerpo')

    <input type="text" onkeyup="filtroid(this.value)" placeholder="Busqueda por numero de alumno..." size="40">
    <select class="" name="mes" onchange="filtromes(this.value)">
      <option value="01">Enero</option>
      <option value="02">Febrero</option>
      <option value="03">Marzo</option>
      <option value="04">Abril</option>
      <option value="05">Mayo</option>
      <option value="06">Junio</option>
      <option value="07">Julio</option>
      <option value="08">Agosto</option>
      <option value="09">Septiembre</option>
      <option value="10">Octubre</option>
      <option value="11">Noviembre</option>
      <option value="12">Diciembre</option>
    </select>

    <div id="tablaBuscador">

    </div>
    <h1 class="text-center">COBROS PENDIENTES</h1>
    <h2>Credito</h2>
    <table class="d-flex justify-content-center">
      <tr>
        <th>Numero de Alumno</th>
        <th>Cupo</th>
        <th>Fecha de cobro</th>
        <th>Valor cuota</th>
        <th>Valor restante</th>
        <th>Tarjeta</th>
        <th>BOTON</th>
        <th>CUPO</th>
      </tr>
      @php
        $bandera = -1;
      @endphp
      @foreach ($estados as $estado )
        @if($estado['fecha_siguiente_cobro'] != '1000-01-01')
          @if ($estado['tipo']=="credito")
              <tr>
                <td>{{$estado['id']}}</td>
                @foreach ($cupos as $cupo)
                  @if ($cupo['id'] == $estado['id'])
                    @php
                      $bandera = $cupo['tiene']; //CONTROLO SI EXISTE EL CUPO GUARDADO
                                    //Y LO GUARDO EN BANDERA
                    @endphp
                  @endif
                @endforeach
                <td id="cupo{{$estado['id']}}">
                @if ($bandera != -1)
                  {{$bandera}}
                  @php
                    $bandera= -1;
                  @endphp
                @else
                  Sin actualizar
                @endif
                </td>
                <td>{{$estado['fecha_siguiente_cobro']}}</td>
                <td>{{$estado['valor_cuota']}}</td>
                <td>{{$estado['valor_restante']}}</td>
                @foreach ($datos as $dato)
                  @if ($dato['id'] == $estado['id'])
                    <td>{{$dato['tarjeta']}}</td>
                  @endif
                @endforeach
                <td class="d-flex justify-content-center"><a class="btn btn-primary" href="/cobro_id/{{$estado['id']}}">COBRAR</a></td>
                <td><button class="btn btn-primary" onclick="actualizarCupo({{$estado['id']}})">Habiztado</button></td>
              </tr>
          @endif
        @endif
      @endforeach

    </table>
    <h2>Debito y Efectivo</h2>
    <table class="d-flex justify-content-center">
      <tr>
        <th>Numero de Alumno</th>
        <th>Tipo</th>  
        <th>Fecha de cobro</th>
        <th>Valor cuota</th>
        <th>Valor restante</th>
        <th>BOTON</th>
      </tr>
      @foreach ($cobrosmes as $estado )
        @if($estado['fecha_siguiente_cobro'] != '1000-01-01')
              <tr>
                <td>{{$estado['id']}}</td>
                <td>{{$estado['tipo']}}</td>
                <td>{{$estado['fecha_siguiente_cobro']}}</td>
                <td>{{$estado['valor_cuota']}}</td>
                <td>{{$estado['valor_restante']}}</td>
                <td class="d-flex justify-content-center"><a href="/cobro_id/{{$estado['id']}}">COBRAR</a></td>
              </tr>
        @endif
      @endforeach
    </table>
    <h3>Buscador</h3>
    <h5>Anda un tok rancio pero anda la puta q te pario pupy</h5>
    <p>Te comento, la movida de la busqueda por mes la flasha un tok y como q
    toma el año tmb pero fijate y se pilotea por ahora yo despues lo arreglo pu</p>
    <h5 id="pu" style="background:#FF8000; padding:15px; cursor:hand;">Presione para ver algo lindo</h5>
    <div id="panel">
      <img src="https://i.imgur.com/PVyH6c3.jpg">
    </div>

@endsection
