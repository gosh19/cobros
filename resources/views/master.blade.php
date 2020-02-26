<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai" rel="stylesheet">

    <link rel="icon" href="{{asset('imagenes/favicon.png')}}" sizes="16x16" type="image/png">

    <title>COBRANZA</title>

  </head>
  <body>
    <header>
      <nav class="navbar navbar-expand-lg navbar-light menu">
        <p class="navbar-brand cabeza-header" href="#">Jarvis 2.0</p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{route ('inicio')}}">INICIO<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route ('cargaralumno')}}">CARGAR ALUMNO</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                COBROS
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{route ('cobrosdia')}}">COBROS DEL DIA</a>
                <a class="dropdown-item" href="{{route ('cobrosmes')}}">COBROS DEL MES</a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Historial
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="/verhistorial">Ver todo</a>
                <a class="dropdown-item" href="/verhistorial/completado">Completados</a>
                <a class="dropdown-item" href="/verhistorial/pendiente">Pendientes</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route ('verhistorial')}}">VER HISTORIAL</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route ('veralumnos')}}">VER ALUMNOS</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <div class="todo">

      <div class="container">
        @yield('cuerpo')
        <div class="formulario">
          @yield('formulario')
        </div>
      </div>

    </div>

    <footer>
      <div class="pie">
        <h4 class="text-center">Ante cualquier falla contactese con el Matu 卐</h4>

      </div>
    </footer>



  </body>
</html>
