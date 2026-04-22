<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <title>Intranet "Tu empresa"</title>
    <link rel="icon" href="img/ico.png" type="image/png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link href="{{ URL::asset('/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
    <link href="{{ asset('css/acciones.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estado.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/b36ad16a06.js" crossorigin="anonymous"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Popper.js and Bootstrap JS -->
    <script type="text/javascript" src="{{ URL::asset('/js/modal-popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('/js/modal-bootstrap.min.js') }}"></script>

    <!-- DataTables -->
    <script language="JavaScript" src="{{ URL::asset('/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{ url('parametros_mantenimiento') }}">
            <img class="logo" src="{{ asset('/img/logo.png') }}" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <button class="btn btn-info" onclick='fnOpenModalAgregarEmpleado()' data-toggle="modal" data-target="#agregar_empleado" title="Agregar empleado">
                      <i class="fa-solid fa-plus"></i>
                    </button>
                </li>
                &nbsp
                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger" style="display: inline; cursor: pointer;" title="Cerrar sesion">
                          <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <p></p>

    @include('home.create_novedades')

    @yield('content')

    <!-- Custom Scripts -->
    <script>
      function wordCount(val) {
          var wom = val.match(/\S+/g);
          return {
              characters: val.length,
          };
      }
      var textarea = document.getElementById("descripcion");
      var result = document.getElementById("result");

      textarea.addEventListener("input", function(){
          var v = wordCount(this.value);
          result.innerHTML = (
              "Caracteres: " + v.characters + "/200"
          );
      }, false);
    </script>
  </body>
</html>