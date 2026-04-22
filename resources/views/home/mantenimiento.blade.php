@extends('layouts.app')
@section('content')

<div class="container text-center" >

    <br><br><br>
  
    <div class="row">
        <br><br>
        @role('Empleado')
            <div class="col text-center">
                <br>
                <a href="{{ url('solicitudes') }}"> <img  src="{{ asset('/img/solicitudes.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Solicitudes</h2>
            </div>
        @endrole
        @role('Empleado-Mantenimiento')
            <div class="col-md-4 text-center">
                <br>
                <a href="{{ url('solicitudes') }}"> <img  src="{{ asset('/img/solicitudes.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Solicitudes</h2>
            </div>
            <div class="col-md-4 text-center">
                <br>
                <a href="{{ url('mantenimientoProgramado') }}"> <img  src="{{ asset('/img/mantenimientoProgramado.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Mantenimiento Programado</h2>
            </div>
            <div class="col-md-4 text-center">
                <br>
                <a href="{{ url('dashboard') }}"> <img  src="{{ asset('/img/dashboard.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Dashboard</h2>
            </div>
        @endrole
        @role('Jefe-Mantenimiento')
            <div class="col-md-4 text-center">
                <br>
                <a href="{{ url('solicitudes') }}"> <img  src="{{ asset('/img/solicitudes.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Solicitudes</h2>
            </div>
            <div class="col-md-4 text-center">
                <br>
                <a href="{{ url('equipos_mant') }}"> <img  src="{{ asset('/img/equipos.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Equipos</h2>
            </div>
            <div class="col-md-4 text-center">
                <br>
                <a href="{{ url('mantenimientoProgramado') }}"> <img  src="{{ asset('/img/mantenimientoProgramado.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Mantenimiento Programado</h2>
            </div>
            <div class="col-md-6 text-center">
                <br>
                <a href="{{ url('dashboard') }}"> <img  src="{{ asset('/img/dashboard.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Dashboard</h2>
            </div>
        @endrole
        @role('Administrador')
            <div class="col-md-4 text-center">
                <br>
                <a href="{{ url('solicitudes') }}"> <img  src="{{ asset('/img/solicitudes.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Solicitudes</h2>
            </div>
            <div class="col-md-4 text-center">
                <br>
                <a href="{{ url('equipos_mant') }}"> <img  src="{{ asset('/img/equipos.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Equipos</h2>
            </div>
            <div class="col-md-4 text-center">
                <br>
                <a href="{{ url('mantenimientoProgramado') }}"> <img  src="{{ asset('/img/mantenimientoProgramado.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Mantenimiento Programado</h2>
            </div>
            <div class="col-md-6 text-center">
                <br>
                <a href="{{ url('dashboard') }}"> <img  src="{{ asset('/img/dashboard.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Dashboard</h2>
            </div>
            <div class="col-md-6 text-center">
                <br>
                <a href="{{ url('parametros_mantenimiento') }}"> <img  src="{{ asset('/img/parametros.png') }}" height="140"></a>
                <h2 style="color: #3b557a">Parametros</h2>
            </div>
        @endrole
    </div>
</div>
<div id="footer-lafedar"></div>

@stop