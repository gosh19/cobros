@extends('master')

@section('cuerpo')

<script>
  function filtroAlumno(str) {
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
          xmlhttp.open("GET","buscador.php?q="+str,true);
          xmlhttp.send();
      }
  }
</script>

<input type="text" onkeyup="filtroAlumno(this.value)" name="" value="" placeholder="Buscador por id...">
<button type="button" name="button" value="0" onclick="filtroAlumno(this.value)">Limpiar</button>
<div id="tablaBuscador"></div>


  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Habilitados</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Bajas</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
    <table>
      <tr>
        <th>Numero Alumno</th>
        <th>Nombre</th>
        <th>DNI</th>
        <th>E-mail</th>
        <th>Tarjeta</th>
        <th>------</th>
      </tr>
      @php
      $bandera =0;
      @endphp
      @foreach ($datos as $dato)
        @foreach ($bajas as $baja)
          @if ($baja['id'] == $dato['id'] )
            @php
            $bandera = 1;
            @endphp
          @endif
        @endforeach
        @if ($bandera != 1)
          <tr>
            <td>{{$dato['id']}}</td>
            <td>{{$dato['nombre']}}</td>
            <td>{{$dato['dni']}}</td>
            <td>{{$dato['mail']}}</td>
            <td>{{$dato['tarjeta']}}</td>
            <td><a href="{{route('alumnoid', ['id' => $dato['id']]) }}">VER</a></td>
          </tr>
        @endif
        @php
        $bandera=0;
        @endphp
      @endforeach
    </table>
  </div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <table>
      <tr>
        <th>Numero Alumno</th>
        <th>Nombre</th>
        <th>DNI</th>
        <th>E-mail</th>
        <th>Tarjeta</th>
        <th>Edicion</th>
      </tr>
      @php
      $bandera =0;
      @endphp
      @foreach ($datos as $dato)
        @foreach ($bajas as $baja)
          @if ($baja['id'] == $dato['id'] )
            @if ($baja['estado']==0)
              <tr>
                <td>{{$dato['id']}}</td>
                <td>{{$dato['nombre']}}</td>
                <td>{{$dato['dni']}}</td>
                <td>{{$dato['mail']}}</td>
                <td>{{$dato['tarjeta']}}</td>
                <td><a href="{{route('alumnoid', ['id' => $dato['id']]) }}">VER</a></td>
              </tr>
            @endif
          @endif
        @endforeach
      @endforeach
    </table>
  </div>
</div>
@endsection
