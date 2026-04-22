<!DOCTYPE html>
<html lang="es">

  <link href="{{ URL::asset('/css/bootstrap.min.css') }}" rel="stylesheet" id="bootstrap-css">
  <script src="https://kit.fontawesome.com/b36ad16a06.js" crossorigin="anonymous"></script>
  <link href="{{ asset('css/acciones.css') }}" rel="stylesheet">
  <link href="{{ asset('css/estado.css') }}" rel="stylesheet">
  <script type="text/javascript" src="{{ URL::asset('/js/modal-jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('/js/modal-popper.min.js') }}"></script>
  <script type="text/javascript" src="{{ URL::asset('/js/modal-bootstrap.min.js') }}"></script>

  <head>
    <meta charset="UTF-8">
    <title>Intranet "Tu empresa"</title>
    <link  rel="icon"   href="img/ico.png" type="image/png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script language="JavaScript" src="{{ URL::asset('/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="{{ url('parametros_mantenimiento') }}"> <img class="logo" src="{{ asset('/img/logo.png') }}" height="40"> </a>
    </nav>
    <p></p>
  </head>
  <script type="text/javascript" src="{{ URL::asset('/js/bootstrap.min.js') }}"></script>
  <body>
    @yield('content')
  </body>
</html>

