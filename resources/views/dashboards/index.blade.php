@extends('dashboards.layouts.layout')
@section('content')

@if(Session::has('message'))
  <div class="container" id="div.alert">
    <div class="row">
      <div class="col-1"></div>
      <div class="alert {{Session::get('alert-class')}} col-10 text-center" role="alert">
        {{Session::get('message')}}
      </div>
    </div>
  </div>
@endif

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12" style="border">
            <h3>Equipos asignados por areas</h3>
            <canvas id="chart2"></canvas>
        </div>
    </div>
    &nbsp
    <div class="row">
        <div class="col-md-6">
            <h3>Solicitudes edilicias por areas</h3>
            <canvas id="chart5"></canvas>
        </div>
        <div class="col-md-6">
            <h3>Solicitudes especializadas por areas</h3>
            <canvas id="chart3"></canvas>
        </div>
    </div>
    &nbsp
    <div class="row">
        <div class="col-md-6">
            <h3>Cantidad de solicitudes por tipo</h3>
            <canvas id="chart1"></canvas>
        </div>
    </div>
</div>

<!-- Script para generar los graficos -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        //SOLICITUDES POR TIPO

        var solicitudesPorTipo = @json($solicitudesPorTipo);
        
        var tiposSolicitudes = [];
        var totalSolicitudes = [];

        solicitudesPorTipo.forEach(function(solicitud) {
            tiposSolicitudes.push(solicitud.nombre); // nombre del tipo de solicitud
            totalSolicitudes.push(solicitud.total_solicitudes); // total de solicitudes
        });

        var ctx1 = document.getElementById('chart1').getContext('2d');
        var chart1 = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: tiposSolicitudes, // Etiquetas del eje X
                datasets: [{
                    label: 'Total de Solicitudes',
                    data: totalSolicitudes, // Total de solicitudes
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        //EQUIPOS POR AREA

        var equiposPorArea = @json($equiposPorArea);
        
        var areas = [];
        var totalEquipos = [];

        equiposPorArea.forEach(function(equipo) {
            areas.push(equipo.nombre_a); // nombre del area
            totalEquipos.push(equipo.total_equipos); // total de solicitudes
        });

        var ctx2 = document.getElementById('chart2').getContext('2d');
        var chart2 = new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: areas,
                datasets: [{
                    label: 'Total de Equipos',
                    data: totalEquipos,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',  // Rojo
                        'rgba(54, 162, 235, 0.2)',  // Azul
                        'rgba(255, 206, 86, 0.2)',  // Amarillo
                        'rgba(75, 192, 192, 0.2)',  // Verde agua
                        'rgba(153, 102, 255, 0.2)', // Púrpura
                        'rgba(255, 159, 64, 0.2)',  // Naranja
                        'rgba(201, 203, 207, 0.2)', // Gris
                        'rgba(255, 99, 71, 0.2)',   // Tomate
                        'rgba(135, 206, 235, 0.2)', // Celeste
                        'rgba(238, 130, 238, 0.2)', // Violeta
                        'rgba(144, 238, 144, 0.2)', // Verde claro
                        'rgba(255, 182, 193, 0.2)', // Rosa claro
                        'rgba(72, 61, 139, 0.2)',   // Azul oscuro
                        'rgba(255, 165, 0, 0.2)',   // Naranja fuerte
                        'rgba(34, 139, 34, 0.2)',   // Verde bosque
                        'rgba(173, 255, 47, 0.2)',  // Verde lima
                        'rgba(106, 90, 205, 0.2)',  // Azul pizarra
                        'rgba(186, 85, 211, 0.2)',  // Orquídea
                        'rgba(255, 140, 0, 0.2)',   // Naranja oscuro
                        'rgba(46, 139, 87, 0.2)',   // Verde mar oscuro
                        'rgba(75, 0, 130, 0.2)',    // Índigo
                        'rgba(220, 20, 60, 0.2)',   // Carmesí
                        'rgba(244, 164, 96, 0.2)'   // Arena dorada
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',  // Rojo
                        'rgba(54, 162, 235, 1)',  // Azul
                        'rgba(255, 206, 86, 1)',  // Amarillo
                        'rgba(75, 192, 192, 1)',  // Verde agua
                        'rgba(153, 102, 255, 1)', // Púrpura
                        'rgba(255, 159, 64, 1)',  // Naranja
                        'rgba(201, 203, 207, 1)', // Gris
                        'rgba(255, 99, 71, 1)',   // Tomate
                        'rgba(135, 206, 235, 1)', // Celeste
                        'rgba(238, 130, 238, 1)', // Violeta
                        'rgba(144, 238, 144, 1)', // Verde claro
                        'rgba(255, 182, 193, 1)', // Rosa claro
                        'rgba(72, 61, 139, 1)',   // Azul oscuro
                        'rgba(255, 165, 0, 1)',   // Naranja fuerte
                        'rgba(34, 139, 34, 1)',   // Verde bosque
                        'rgba(173, 255, 47, 1)',  // Verde lima
                        'rgba(106, 90, 205, 1)',  // Azul pizarra
                        'rgba(186, 85, 211, 1)',  // Orquídea
                        'rgba(255, 140, 0, 1)',   // Naranja oscuro
                        'rgba(46, 139, 87, 1)',   // Verde mar oscuro
                        'rgba(75, 0, 130, 1)',    // Índigo
                        'rgba(220, 20, 60, 1)',   // Carmesí
                        'rgba(244, 164, 96, 1)'   // Arena dorada
                    ],
                    borderWidth: 1
                }]
            },
        });

        //SOLICITUDES POR AREA Especializado
        
        var solicitudesPorAreaEspecializado = @json($solicitudesPorAreaEspecializado);
        
        var areas = [];
        var totalSolicitudes = [];

        solicitudesPorAreaEspecializado.forEach(function(solicitud) {
            areas.push(solicitud.nombre_a); // nombre del area
            totalSolicitudes.push(solicitud.total_solicitudes); // total de solicitudes
        });
        

        var ctx3 = document.getElementById('chart3').getContext('2d');
        var chart3 = new Chart(ctx3, {
            type: 'pie',
            data: {
                labels: areas, // Etiquetas del eje X
                datasets: [{
                    label: 'Total de Solicitudes',
                    data: totalSolicitudes,
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            }
        });

        //SOLICITUDES POR AREA Edilicio
        
        var solicitudesPorAreaEdilicio = @json($solicitudesPorAreaEdilicio);
        
        var areas = [];
        var totalSolicitudes = [];

        solicitudesPorAreaEdilicio.forEach(function(solicitud) {
            areas.push(solicitud.nombre_a); // nombre del area
            totalSolicitudes.push(solicitud.total_solicitudes); // total de solicitudes
        });
        

        var ctx5 = document.getElementById('chart5').getContext('2d');
        var chart5 = new Chart(ctx5, {
            type: 'pie',
            data: {
                labels: areas, // Etiquetas del eje X
                datasets: [{
                    label: 'Total de Solicitudes',
                    data: totalSolicitudes,
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            }
        });
    });
</script>

@stop