@extends('layouts.app_parametros_mant')
@section('content')

<div class="container text-center">

    <br><br><br>
  
    <div class="row">
        <br><br>
        <div class="col-md-4 text-center">
            <br>
            <a href="{{ url('empleado') }}"><img src="{{ asset('/img/empleados.png') }}" height="140"></a>
            <h3 style="color: #3b557a">Empleados</h3>
        </div>
        <div class="col-md-4 text-center">
            <br>
            <a href="{{ url('usuarios') }}"><img src="{{ asset('/img/usuarios.png') }}" height="140"></a>
            <h3 style="color: #3b557a">Usuarios</h3>
        </div>
        <div class="col-md-4 text-center">
            <br>
            <a href="{{ url('roles') }}"><img src="{{ asset('/img/roles.png') }}" height="140"></a>
            <h3 style="color: #3b557a">Roles</h3>
        </div>

        <div class="col-md-6 text-center">
            <br>
            <a href="{{ url('areas') }}"><img src="{{ asset('/img/areas.png') }}" height="140"></a>
            <h3 style="color: #3b557a">Areas</h3>
        </div>
        <div class="col-md-6 text-center">
            <br>
            <a href="{{ url('localizaciones') }}"><img src="{{ asset('/img/localizaciones.png') }}" height="140"></a>
            <h3 style="color: #3b557a">Localizaciones</h3>
        </div>

        <div class="col-md-4 text-center">
            <br>
            <a href="{{ url('tipos_equipos') }}"><img src="{{ asset('/img/tipos de equipos.png') }}" height="140"></a>
            <h3 style="color: #3b557a">Tipos de equipos</h3>
        </div>
        <div class="col-md-4 text-center">
            <br>
            <a href="{{ url('backup') }}"><img src="{{ asset('/img/backup.png') }}" height="140"></a>
            <h3 style="color: #3b557a">Descargar back up</h3>
        </div>
        <div class="col-md-4 text-center">
            <br>
            <a href="{{ url('restore') }}"><img src="{{ asset('/img/backup.png') }}" height="140"></a>
            <h3 style="color: #3b557a">Restaurar back up</h3>
        </div>

    </div>

</div>
<div id="footer-lafedar"></div>

@stop