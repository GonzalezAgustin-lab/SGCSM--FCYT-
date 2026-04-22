@extends('layouts.app')

@section('content')

    {{-- CSS adicional del sistema --}}
    <link rel="stylesheet" href="{{ URL::asset('/css/acciones.css') }}">
    {{-- Font Awesome (para íconos como en el resto del sistema) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Paleta y tokens del sistema */
        :root {
            --color-primary: #21547d;
            --color-primary-light: #4e6f9e;
            --color-accent: #ffc107;
            --color-success: #28a745;
            --color-danger: #dc3545;
            --color-info: #17a2b8;
            --color-dark: #212529;
        }

        /* ---- estructura general ---- */
        .ayuda-wrapper {
            max-width: 920px;
            width: 100%;
            margin: 0 auto;
            padding: 20px 15px 60px;
            min-height: 100vh;
        }

        /* ---- encabezado ---- */
        .ayuda-header {
            background: var(--color-primary);
            color: #fff;
            border-radius: 8px;
            padding: 24px 28px 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .ayuda-header .ayuda-icon-big {
            font-size: 2.8rem;
            line-height: 1;
        }

        .ayuda-header h2 {
            margin: 0;
            font-size: 1.7rem;
        }

        .ayuda-header p {
            margin: 4px 0 0;
            opacity: .85;
            font-size: .95rem;
        }

        /* ---- nav-tabs de roles ---- */
        .nav-tabs .nav-link {
            color: var(--color-primary);
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            color: #fff;
            background: var(--color-primary);
            border-color: var(--color-primary);
        }

        .nav-tabs .nav-link:hover:not(.active) {
            background: #eef2f8;
        }

        /* ---- sección de colores por rol ---- */
        .section-empleado .card-header {
            background: var(--color-primary);
            color: #fff;
        }

        .section-tecnico .card-header {
            background: var(--color-primary);
            color: #fff;
        }

        .section-jefe .card-header {
            background: var(--color-primary);
            color: #fff;
        }

        .section-admin .card-header {
            background: var(--color-primary);
            color: #fff;
        }

        /* ---- tarjetas de ayuda ---- */
        .help-card {
            border: 1px solid #d0d8e8;
            border-radius: 6px;
            margin-bottom: 5px;
        }

        .help-card .card-header {
            background: #f0f4fa;
            border-bottom: 1px solid #d0d8e8;
            padding: 0;
        }

        .help-card .card-header button {
            color: var(--color-primary);
            font-weight: 600;
            font-size: .97rem;
            width: 100%;
            text-align: left;
            padding: 12px 16px;
            white-space: normal;
        }

        .help-card .card-header button:hover {
            text-decoration: none;
            color: var(--color-primary-light);
        }

        .help-card .card-header button.collapsed {
            color: #555;
            font-weight: 500;
        }

        /* ---- pasos numerados ---- */
        .step-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .step-list li {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 7px 0;
            border-bottom: 1px dashed #e0e0e0;
        }

        .step-list li:last-child {
            border-bottom: none;
        }

        .step-num {
            min-width: 28px;
            height: 28px;
            background: var(--color-primary);
            color: #fff;
            border-radius: 50%;
            font-size: .8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* ---- tabla de íconos de acciones ---- */
        .icon-table td {
            vertical-align: middle;
            padding: 6px 10px;
        }

        .icon-table tr:hover td {
            background: #f5f5f5;
        }

        /* ---- tip-box ---- */
        .tip-box {
            background: #fff8e1;
            border-left: 4px solid var(--color-accent);
            padding: 10px 14px;
            border-radius: 0 4px 4px 0;
            font-size: .9rem;
            margin-top: 10px;
        }

        .warning-box {
            background: #fff3cd;
            border-left: 4px solid var(--color-danger);
            padding: 10px 14px;
            border-radius: 0 4px 4px 0;
            font-size: .9rem;
            margin-top: 10px;
        }

        /* ---- estado badges (alineados con el sistema) ---- */
        .badge-estado-abierta {
            background: #6c757d;
            /* gris */
            color: #fff;
        }

        .badge-estado-asignada {
            background: #0d6efd;
            /* azul */
            color: #fff;
        }

        .badge-estado-proceso {
            background: var(--color-info);
            /* celeste */
            color: #fff;
        }

        .badge-estado-rep-pendiente {
            background: #fd7e14;
            /* naranja */
            color: #fff;
        }

        .badge-estado-aprobpend {
            background: #ffc107;
            /* amarillo */
            color: #212529;
        }

        .badge-estado-finalizada {
            background: var(--color-success);
            /* verde */
            color: #fff;
        }

        .badge-estado-rechazada {
            background: var(--color-danger);
            /* rojo */
            color: #fff;
        }

        /* ---- sección de contacto ---- */
        .contact-box {
            background: var(--color-primary);
            color: #fff;
            border-radius: 8px;
            padding: 20px 24px;
            margin-top: 10px;
        }

        .contact-box a {
            color: #ffd;
        }
    </style>

    <div class="ayuda-wrapper">

        {{-- Encabezado --}}
        <div class="ayuda-header">
            <div class="ayuda-icon-big">❓</div>
            <div>
                <h2>Centro de Ayuda — SGCSM</h2>
                <p>Sistema de Gestión de Solicitudes de Mantenimiento · Intranet "Tu empresa"</p>
            </div>
        </div>

        <a href="{{ url('home') }}" class="btn btn-sm btn-outline-secondary mb-4">
            <i class="fa-solid fa-arrow-left"></i> &nbsp;Volver al inicio
        </a>

        {{-- ========================================================
        SECCIÓN: EMPLEADO COMÚN
        ======================================================== --}}
        @role('Empleado|Administrador')
        <div class="section-empleado">

            {{-- Título de sección --}}
            <div class="card mb-2">
                <div class="card-header">
                    <i class="fa-solid fa-user"></i> &nbsp; Guía para Empleados
                </div>
            </div>

            {{-- 1. Crear una solicitud --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#emp-crear">
                        <i class="fa-solid fa-plus-circle agregar"></i> &nbsp; ¿Cómo crear una solicitud de mantenimiento?
                    </button>
                </div>
                <div id="emp-crear" class="collapse">
                    <div class="card-body">
                        <p>Podés crear dos tipos de solicitudes: <strong>Especializada</strong> (equipo específico) o
                            <strong>Edilicia</strong> (infraestructura).
                        </p>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Desde el inicio, hacé click en el ícono
                                    <strong>Solicitudes</strong>.</span></li>
                            <li><span class="step-num">2</span><span>En el listado, buscá el botón <strong><i
                                            class="fa-solid fa-plus agregar"></i> Nueva Solicitud</strong> y hacé
                                    click.</span></li>
                            <li><span class="step-num">3</span><span>Seleccioná el <strong>Tipo de solicitud</strong>:
                                    <ul class="mt-1">
                                        <li><strong>Especializada:</strong> completá el equipo, área, localización y
                                            descripción de la falla.</li>
                                        <li><strong>Edilicia:</strong> completá área, localización y una descripción del
                                            problema.</li>
                                    </ul>
                                </span></li>
                            <li><span class="step-num">4</span><span>Escribí un <strong>Título</strong> claro y conciso para
                                    la solicitud.</span></li>
                            <li><span class="step-num">5</span><span>Hacé click en <strong>Guardar</strong>. La solicitud
                                    quedará en estado <span class="badge badge-estado-abierta">Abierta</span>.</span></li>
                        </ul>
                        <div class="tip-box mt-3">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            <strong>Consejo:</strong> Cuanto más detallada sea la descripción, más rápido podrá el equipo de
                            mantenimiento atender tu solicitud.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Ver y filtrar solicitudes --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#emp-ver">
                        <i class="fa-solid fa-list detalle"></i> &nbsp; ¿Cómo ver y filtrar mis solicitudes?
                    </button>
                </div>
                <div id="emp-ver" class="collapse">
                    <div class="card-body">
                        <p>El listado de solicitudes cuenta con una barra de búsqueda con múltiples filtros:</p>
                        <table class="table table-sm table-bordered icon-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Filtro</th>
                                    <th>Descripción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>ID</strong></td>
                                    <td>Número único de la solicitud.</td>
                                </tr>
                                <tr>
                                    <td><strong>Título</strong></td>
                                    <td>Palabra clave del título de la solicitud.</td>
                                </tr>
                                <tr>
                                    <td><strong>Tipo</strong></td>
                                    <td>Especializada o Edilicia.</td>
                                </tr>
                                <tr>
                                    <td><strong>Equipo</strong></td>
                                    <td>Código del equipo involucrado.</td>
                                </tr>
                                <tr>
                                    <td><strong>Estado</strong></td>
                                    <td>Filtrá por estado actual.</td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha</strong></td>
                                    <td>Fecha de emisión de la solicitud.</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="mt-2">Presioná el ícono <i class="fa-solid fa-magnifying-glass"></i> para aplicar los
                            filtros.</p>
                    </div>
                </div>
            </div>

            {{-- 3. Estados --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#emp-estados">
                        <i class="fa-solid fa-circle-half-stroke" style="color:var(--color-primary)"></i> &nbsp; ¿Qué
                        significan los estados de una solicitud?
                    </button>
                </div>
                <div id="emp-estados" class="collapse">
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-hover icon-table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Estado</th>
                                    <th>Significado</th>
                                    <th>¿Podés editarla?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-estado-abierta">Abierta</span></td>
                                    <td>La solicitud fue registrada y se encuentra a la espera de ser asignada a un técnico.
                                    </td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-check" style="color:var(--color-success)"></i> Sí
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-estado-asignada">Asignada</span></td>
                                    <td>La solicitud ya fue asignada a un técnico responsable.</td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-xmark" style="color:var(--color-danger)"></i> No
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-estado-proceso">En proceso</span></td>
                                    <td>Un técnico se encuentra trabajando en la resolución del problema.</td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-xmark" style="color:var(--color-danger)"></i> No
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-estado-rep-pendiente">Rep. pendiente</span></td>
                                    <td>El técnico solicitó repuestos necesarios para continuar con la reparación.</td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-xmark" style="color:var(--color-danger)"></i> No
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-estado-aprobpend">Aprob. pendiente</span></td>
                                    <td>El técnico finalizó el trabajo. <strong>Se requiere tu aprobación</strong> para
                                        cerrar la solicitud.</td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-xmark" style="color:var(--color-danger)"></i> No
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-estado-finalizada">Aprobada</span></td>
                                    <td>El mantenimiento fue completado y aprobado. La solicitud se encuentra cerrada.</td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-xmark" style="color:var(--color-danger)"></i> No
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-estado-rechazada">Reclamada</span></td>
                                    <td>La solicitud fue rechazada por el solicitante y requiere revisión.</td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-xmark" style="color:var(--color-danger)"></i> No
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- 4. Acciones disponibles --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#emp-acciones">
                        <i class="fa-solid fa-sliders" style="color:var(--color-primary)"></i> &nbsp; ¿Qué acciones puedo
                        hacer sobre una solicitud?
                    </button>
                </div>
                <div id="emp-acciones" class="collapse">
                    <div class="card-body">
                        <p>En la columna <strong>Acciones</strong> del listado encontrarás íconos. Esta es la guía de cada
                            ícono:</p>
                        <table class="table table-sm table-bordered table-hover icon-table">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:50px">Ícono</th>
                                    <th>Función</th>
                                    <th>Cuándo está disponible</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><i class="fa-solid fa-circle-info fa-lg detalle"></i></td>
                                    <td><strong>Detalle</strong> — muestra toda la información de la solicitud y su
                                        historial de cambios.</td>
                                    <td>Siempre</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i
                                            class="fa-solid fa-arrow-up-from-bracket fa-lg actualizar-editar"></i></td>
                                    <td><strong>Actualizar</strong> — permite agregar una actualización o comentario al
                                        historial.</td>
                                    <td>Siempre</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i
                                            class="fa-solid fa-pen-to-square fa-lg actualizar-editar"></i></td>
                                    <td><strong>Editar</strong> — modificá el título, tipo o descripción de la solicitud.
                                    </td>
                                    <td>Solo cuando está en estado <span class="badge badge-estado-abierta">Abierta</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa-solid fa-check fa-lg aprobar"></i></td>
                                    <td><strong>Aprobar</strong> — confirmás que el trabajo fue realizado correctamente y
                                        cerrás la solicitud.</td>
                                    <td>Cuando está en <span class="badge badge-estado-aprobpend">Aprob. pendiente</span> y
                                        sos el solicitante</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="fa-solid fa-bullhorn fa-lg reclamar"></i></td>
                                    <td><strong>Reclamar</strong> — enviás un reclamo si el trabajo no fue realizado
                                        correctamente o necesitás revisión.</td>
                                    <td>Cuando está en <span class="badge badge-estado-aprobpend">Aprob. pendiente</span> y
                                        sos el solicitante</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- 5. Aprobar o reclamar --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#emp-aprobar">
                        <i class="fa-solid fa-check-double" style="color:var(--color-success)"></i> &nbsp; ¿Cómo aprobar o
                        reclamar una solicitud finalizada?
                    </button>
                </div>
                <div id="emp-aprobar" class="collapse">
                    <div class="card-body">
                        <p>Cuando un técnico da por finalizado el trabajo, la solicitud pasa a <span
                                class="badge badge-estado-aprobpend">Aprob. pendiente</span>. Vos como solicitante tenés que
                            revisarla:</p>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá al listado de
                                    <strong>Solicitudes</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Buscá la solicitud con estado <span
                                        class="badge badge-estado-aprobpend">Aprob. pendiente</span>.</span></li>
                            <li><span class="step-num">3</span><span><strong>Si el trabajo está conforme:</strong> hacé
                                    click en <i class="fa-solid fa-check aprobar"></i> <strong>Aprobar</strong>. La
                                    solicitud pasará a <span class="badge badge-estado-finalizada">Aprobada</span>.</span>
                            </li>
                            <li><span class="step-num">4</span><span><strong>Si encontrás problemas:</strong> hacé click en
                                    <i class="fa-solid fa-bullhorn reclamar"></i> <strong>Reclamar</strong>, completá la
                                    descripción del problema y enviá el reclamo. El equipo de mantenimiento recibirá la
                                    novedad.</span></li>
                        </ul>
                        <div class="warning-box">
                            <i class="fa-solid fa-triangle-exclamation" style="color:var(--color-danger)"></i>
                            <strong>Importante:</strong> Si no aprobás ni reclamás, la solicitud quedará pendiente
                            indefinidamente. ¡Revisá siempre tus solicitudes cuando lleguen a este estado!
                        </div>
                    </div>
                </div>
            </div>

            {{-- 6. Editar una solicitud --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#emp-editar">
                        <i class="fa-solid fa-pen-to-square actualizar-editar"></i> &nbsp; ¿Cómo editar una solicitud que ya
                        envié?
                    </button>
                </div>
                <div id="emp-editar" class="collapse">
                    <div class="card-body">
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Solo podés editar solicitudes propias que estén en
                                    estado <span class="badge badge-estado-abierta">Abierta</span>.</span></li>
                            <li><span class="step-num">2</span><span>En la fila de la solicitud, hacé click en el ícono <i
                                        class="fa-solid fa-pen-to-square actualizar-editar"></i>.</span></li>
                            <li><span class="step-num">3</span><span>Modificá los campos necesarios (título, tipo,
                                    descripción, equipo, área o localización).</span></li>
                            <li><span class="step-num">4</span><span>Hacé click en <strong>Guardar</strong> para aplicar los
                                    cambios.</span></li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            Una vez que la solicitud fue asignada a un técnico ya no podrás editarla.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 7. Ver historial --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#emp-historial">
                        <i class="fa-solid fa-clock-rotate-left" style="color:var(--color-primary)"></i> &nbsp; ¿Cómo ver el
                        historial de cambios de una solicitud?
                    </button>
                </div>
                <div id="emp-historial" class="collapse">
                    <div class="card-body">
                        <p>El historial registra todos los cambios de estado y comentarios realizados sobre la solicitud.
                        </p>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Hacé click en el ícono <i
                                        class="fa-solid fa-circle-info detalle"></i> <strong>Detalle</strong> de cualquier
                                    solicitud.</span></li>
                            <li><span class="step-num">2</span><span>Se abrirá un panel con todos los datos de la
                                    solicitud.</span></li>
                            <li><span class="step-num">3</span><span>En la parte inferior verás el <strong>Historial de
                                        estados</strong>: fecha, estado, responsable y descripción de cada cambio.</span>
                            </li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            Revisá el historial para conocer en qué etapa está el trabajo y qué acciones se tomaron.
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endrole

        {{-- ========================================================
        SECCIÓN: EMPLEADO DE MANTENIMIENTO (técnico)
        ======================================================== --}}
        @role('Empleado-Mantenimiento|Administrador')
        <div class="section-tecnico mt-4">

            <div class="card mb-2">
                <div class="card-header">
                    <i class="fa-solid fa-screwdriver-wrench"></i> &nbsp; Guía para Empleados de Mantenimiento
                </div>
            </div>

            {{-- 1. Ver solicitudes asignadas --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#tec-ver-asignadas">
                        <i class="fa-solid fa-list-check" style="color:#16a085"></i> &nbsp; ¿Cómo ver mis solicitudes
                        asignadas?
                    </button>
                </div>
                <div id="tec-ver-asignadas" class="collapse">
                    <div class="card-body">
                        <p>Como Empleado de Mantenimiento solo ves las solicitudes que el Jefe te asignó directamente. No
                            tenés acceso a las solicitudes de otros técnicos.</p>
                        <ul class="step-list">
                            <li><span class="step-num" style="background:#16a085">1</span><span>Desde el inicio hacé click
                                    en <strong>Solicitudes</strong>.</span></li>
                            <li><span class="step-num" style="background:#16a085">2</span><span>El listado mostrará
                                    únicamente las solicitudes en las que sos el <strong>Encargado asignado</strong>.
                                </span>
                            </li>
                            <li>
                                <span class="step-num" style="background:#16a085">3</span><span>Podés filtrar por
                                    <strong>Estado</strong>, <strong>Tipo</strong>, <strong>Fecha</strong> o
                                    <strong>Equipo</strong> para encontrar solicitudes específicas rápidamente.

                                </span>
                            </li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            Filtrá por estado <span class="badge badge-estado-proceso">En proceso</span> para ver
                            rápidamente las solicitudes activas que tenés pendientes de resolver.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Actualizar el estado de una solicitud --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#tec-actualizar">
                        <i class="fa-solid fa-arrow-up-from-bracket actualizar-editar"></i> &nbsp; ¿Cómo registrar el avance
                        de una solicitud?
                    </button>
                </div>
                <div id="tec-actualizar" class="collapse">
                    <div class="card-body">
                        <p>La función <strong>Actualizar</strong> es tu herramienta principal. Cada vez que avancés en el
                            trabajo debés registrar el progreso para mantener al solicitante informado.</p>
                        <ul class="step-list">
                            <li><span class="step-num" style="background:#16a085">1</span><span>En la fila de la solicitud,
                                    hacé click en <i class="fa-solid fa-arrow-up-from-bracket actualizar-editar"></i>
                                    <strong>Actualizar</strong>.</span></li>
                            <li><span class="step-num" style="background:#16a085">2</span><span>Seleccioná el <strong>nuevo
                                        estado</strong> según la etapa del trabajo:
                                    <table class="table table-sm table-bordered mt-2">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Estado a elegir</th>
                                                <th>Cuándo usarlo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="badge badge-estado-proceso">En proceso</span></td>
                                                <td>Cuando comenzaste a trabajar en la solicitud.</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge badge-estado-rep-pendiente">Rep. pendiente</span>
                                                </td>
                                                <td>Cuando faltan repuestos para continuar con la reparación.</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge badge-estado-aprobpend">Aprob. pendiente</span></td>
                                                <td>Cuando terminaste el trabajo y esperás la conformidad del solicitante.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </span></li>
                            <li><span class="step-num" style="background:#16a085">3</span><span>Describí detalladamente las
                                    <strong>tareas realizadas</strong>: qué revisaste, qué reparaste, qué
                                    encontraste.</span></li>
                            <li><span class="step-num" style="background:#16a085">4</span><span>Indicá si se utilizaron
                                    <strong>repuestos</strong> (esto es importante para el registro de stock).</span></li>
                            <li><span class="step-num" style="background:#16a085">5</span><span>Hacé click en
                                    <strong>Guardar</strong>. El historial se actualizará y el solicitante podrá ver el
                                    avance.</span></li>
                        </ul>
                        <div class="warning-box">
                            <i class="fa-solid fa-triangle-exclamation" style="color:var(--color-danger)"></i>
                            <strong>Importante:</strong> No olvides cambiar el estado a <span
                                class="badge badge-estado-aprobpend">Aprob. pendiente</span> cuando terminés el trabajo. Si
                            no lo hacés, la solicitud quedará en <span class="badge badge-estado-proceso">En proceso</span>
                            indefinidamente y el solicitante no podrá aprobarla.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Ver el detalle e historial --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#tec-detalle">
                        <i class="fa-solid fa-circle-info detalle"></i> &nbsp; ¿Cómo ver el detalle e historial de una
                        solicitud?
                    </button>
                </div>
                <div id="tec-detalle" class="collapse">
                    <div class="card-body">
                        <ul class="step-list">
                            <li><span class="step-num" style="background:#16a085">1</span><span>Hacé click en el ícono <i
                                        class="fa-solid fa-circle-info detalle"></i> <strong>Detalle</strong> de la
                                    solicitud.</span></li>
                            <li><span class="step-num" style="background:#16a085">2</span><span>Se abrirá un panel con:<ul
                                        class="mt-1">
                                        <li><strong>Datos generales:</strong> título, tipo, equipo, área, solicitante y
                                            fecha.</li>
                                        <li><strong>Descripción completa</strong> del problema reportado.</li>
                                        <li><strong>Historial de estados:</strong> todos los registros previos con fechas y
                                            descripciones.</li>
                                    </ul></span></li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            Leé siempre el historial completo antes de empezar. Puede haber actualizaciones previas del
                            solicitante o de otro técnico con información relevante.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Solicitudes con repuestos --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#tec-repuestos">
                        <i class="fa-solid fa-boxes-stacked" style="color:#16a085"></i> &nbsp; ¿Cómo registrar el uso de
                        repuestos?
                    </button>
                </div>
                <div id="tec-repuestos" class="collapse">
                    <div class="card-body">
                        <p>Cuando usés repuestos durante un mantenimiento, es obligatorio registrarlo en la actualización de
                            la solicitud.</p>
                        <ul class="step-list">
                            <li><span class="step-num" style="background:#16a085">1</span><span>Al actualizar una solicitud,
                                    localizá la opción <strong>"¿Se utilizaron repuestos?"</strong>.</span></li>
                            <li><span class="step-num" style="background:#16a085">2</span><span>Marcá <strong>Sí</strong> y
                                    agregá en la descripción el detalle de los repuestos utilizados (nombre, cantidad,
                                    motivo).</span></li>
                            <li><span class="step-num" style="background:#16a085">3</span><span>Esta información queda
                                    registrada en el historial y puede ser consultada por el Jefe de Mantenimiento.</span>
                            </li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            El registro del uso de repuestos queda guardado en el historial de la solicitud y puede ser
                            consultado por el Jefe de Mantenimiento en cualquier momento.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 5. Generar reporte PDF --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#tec-reporte">
                        <i class="fa-solid fa-file-arrow-down" style="color:var(--color-info)"></i> &nbsp; ¿Cómo generar un
                        reporte PDF de mis solicitudes?
                    </button>
                </div>
                <div id="tec-reporte" class="collapse">
                    <div class="card-body">
                        <ul class="step-list">
                            <li><span class="step-num" style="background:#16a085">1</span><span>En el listado de
                                    <strong>Solicitudes</strong>, marcá las casillas <i
                                        class="fa-regular fa-square-check"></i> de las solicitudes que querés
                                    incluir.</span></li>
                            <li><span class="step-num" style="background:#16a085">2</span><span>Hacé click en el botón <i
                                        class="fa-solid fa-file-arrow-down" style="color:var(--color-info)"></i> al pie del
                                    listado.</span></li>
                            <li><span class="step-num" style="background:#16a085">3</span><span>Se descargará un
                                    <strong>PDF</strong> con el detalle de cada solicitud seleccionada y su historial
                                    completo de estados.</span></li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            Podés usar este reporte para presentar un resumen de los trabajos realizados durante un período
                            al Jefe de Mantenimiento.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 6. Íconos disponibles --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#tec-iconos">
                        <i class="fa-solid fa-sliders" style="color:#16a085"></i> &nbsp; ¿Qué íconos de acción tengo
                        disponibles?
                    </button>
                </div>
                <div id="tec-iconos" class="collapse">
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-hover icon-table">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width:50px">Ícono</th>
                                    <th>Función</th>
                                    <th>Disponibilidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><i class="fa-solid fa-circle-info fa-lg detalle"></i></td>
                                    <td><strong>Detalle</strong> — ver toda la información e historial de la solicitud.</td>
                                    <td>Siempre</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i
                                            class="fa-solid fa-arrow-up-from-bracket fa-lg actualizar-editar"></i></td>
                                    <td><strong>Actualizar</strong> — registrar avances, cambiar estado e indicar uso de
                                        repuestos.</td>
                                    <td>Siempre (en tus solicitudes asignadas)</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="tip-box mt-2">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            A diferencia de otros roles, <strong>no podés asignar, aprobar ni eliminar</strong> solicitudes.
                            Esas acciones son exclusivas del Jefe de Mantenimiento y el Administrador.
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endrole

        {{-- ========================================================
        SECCIÓN: JEFE DE MANTENIMIENTO
        ======================================================== --}}
        @role('Jefe-Mantenimiento|Administrador')
        <div class="section-jefe">

            <div class="card mt-4 mb-2">
                <div class="card-header">
                    <i class="fa-solid fa-helmet-safety"></i> &nbsp; Guía para Jefe de Mantenimiento
                </div>
            </div>

            {{-- 1. Asignar solicitud --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#jefe-asignar">
                        <i class="fa-solid fa-user-plus asignar"></i> &nbsp; ¿Cómo asignar una solicitud a un técnico?
                    </button>
                </div>
                <div id="jefe-asignar" class="collapse">
                    <div class="card-body">
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá a <strong>Solicitudes</strong> desde el menú de
                                    inicio.</span></li>
                            <li><span class="step-num">2</span><span>Filtrá por estado <span
                                        class="badge badge-estado-abierta">Abierta</span> para ver las que están sin
                                    asignar.</span></li>
                            <li><span class="step-num">3</span><span>Hacé click en el ícono <i
                                        class="fa-solid fa-user-plus asignar"></i> <strong>Asignar</strong> en la fila de la
                                    solicitud que querés gestionar.</span></li>
                            <li><span class="step-num">4</span><span>En el formulario, seleccioná el <strong>técnico
                                        encargado</strong> del listado desplegable.</span></li>
                            <li><span class="step-num">5</span><span>Hacé click en <strong>Guardar</strong>. La solicitud
                                    pasará al estado <span class="badge badge-estado-proceso">En proceso</span> y el técnico
                                    podrá verla.</span></li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            Solo aparecen en el listado los usuarios con el rol de
                            <strong>Empleado-Mantenimiento</strong>.Si
                            un técnico no aparece, verificá que tenga el rol correcto asignado.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Actualizar solicitud --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#jefe-actualizar">
                        <i class="fa-solid fa-arrow-up-from-bracket actualizar-editar"></i> &nbsp; ¿Cómo actualizar el
                        estado de una solicitud?
                    </button>
                </div>
                <div id="jefe-actualizar" class="collapse">
                    <div class="card-body">
                        <p>Durante el trabajo, el técnico debe registrar avances y cambios de estado mediante la función
                            <strong>Actualizar</strong>.
                        </p>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Hacé click en el ícono <i
                                        class="fa-solid fa-arrow-up-from-bracket actualizar-editar"></i> de la solicitud
                                    correspondiente.</span></li>
                            <li><span class="step-num">2</span><span>Seleccioná el nuevo <strong>estado</strong> de la
                                    solicitud.</span></li>
                            <li><span class="step-num">3</span><span>Completá la descripción del avance, las tareas
                                    realizadas y si se utilizaron <strong>repuestos</strong>.</span></li>
                            <li><span class="step-num">4</span><span>Hacé click en <strong>Guardar</strong>. El historial se
                                    actualizará automáticamente.</span></li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            Cuando el trabajo esté listo, cambiá el estado a <span
                                class="badge badge-estado-aprobpend">Aprob. pendiente</span>. El solicitante recibirá la
                            notificación para aprobar o reclamar.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. Gestionar equipos --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#jefe-equipos">
                        <i class="fa-solid fa-gears" style="color:var(--color-primary)"></i> &nbsp; ¿Cómo gestionar los
                        equipos de mantenimiento?
                    </button>
                </div>
                <div id="jefe-equipos" class="collapse">
                    <div class="card-body">
                        <p>El módulo de <strong>Equipos</strong> contiene el inventario de todos los equipos industriales de
                            la empresa.</p>

                        <h6 class="mt-3" style="color:var(--color-primary)"><i class="fa-solid fa-plus agregar"></i> Agregar
                            un equipo nuevo</h6>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Desde el inicio, hacé click en
                                    <strong>Equipos</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Presioná el botón <strong>Nuevo Equipo</strong>.</span>
                            </li>
                            <li><span class="step-num">3</span><span>Completá: <strong>ID del equipo</strong>, <strong>Tipo
                                        de equipo</strong>, <strong>Área</strong> y <strong>Localización</strong>.</span>
                            </li>
                            <li><span class="step-num">4</span><span>Podés añadir una descripción técnica detallada del
                                    equipo.</span></li>
                            <li><span class="step-num">5</span><span>Hacé click en <strong>Guardar</strong>.</span></li>
                        </ul>

                        <h6 class="mt-3" style="color:#e67e22"><i class="fa-solid fa-pen-to-square actualizar-editar"></i>
                            Editar un equipo existente</h6>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>En el listado de equipos, hacé click en el ícono de
                                    <strong>Editar</strong> del equipo que querés modificar.</span></li>
                            <li><span class="step-num">2</span><span>Actualizá los campos necesarios y guardá los
                                    cambios.</span></li>
                        </ul>

                        <div class="tip-box mt-2">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            El ID del equipo se usa en las solicitudes especializadas para identificar exactamente qué
                            máquina o instalación necesita mantenimiento.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Mantenimiento programado --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#jefe-mant-prog">
                        <i class="fa-solid fa-calendar-check" style="color:var(--color-primary)"></i> &nbsp; ¿Cómo gestionar
                        el mantenimiento preventivo programado?
                    </button>
                </div>
                <div id="jefe-mant-prog" class="collapse">
                    <div class="card-body">
                        <p>El módulo de <strong>Mantenimiento Programado</strong> permite planificar tareas preventivas
                            sobre los equipos.</p>

                        <h6 class="mt-3" style="color:var(--color-primary)"><i class="fa-solid fa-plus agregar"></i> Crear
                            un mantenimiento programado</h6>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Desde el inicio, hacé click en <strong>Mantenimiento
                                        Programado</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Hacé click en <strong>Nuevo
                                        Mantenimiento</strong>.</span></li>
                            <li><span class="step-num">3</span><span>Seleccioná el o los <strong>equipos</strong> que van a
                                    recibir el mantenimiento.</span></li>
                            <li><span class="step-num">4</span><span>Establecé la <strong>fecha programada</strong> y
                                    escribí una descripción del trabajo preventivo a realizar.</span></li>
                            <li><span class="step-num">5</span><span>Asigná un <strong>encargado</strong> para el
                                    trabajo.</span></li>
                            <li><span class="step-num">6</span><span>Hacé click en <strong>Guardar</strong>.</span></li>
                        </ul>

                        <h6 class="mt-3" style="color:#e67e22"><i class="fa-solid fa-pen-to-square actualizar-editar"></i>
                            Editar o completar un mantenimiento programado</h6>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>En el listado, hacé click en el ícono de
                                    <strong>Editar</strong> del mantenimiento.</span></li>
                            <li><span class="step-num">2</span><span>Podés cambiar la fecha, el encargado, agregar
                                    observaciones o registrar el trabajo realizado.</span></li>
                            <li><span class="step-num">3</span><span>Guardá los cambios.</span></li>
                        </ul>

                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            Mantener actualizado el mantenimiento preventivo reduce las fallas inesperadas y prolonga la
                            vida útil de los equipos.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 5. Ver el dashboard --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#jefe-dashboard">
                        <i class="fa-solid fa-chart-line" style="color:var(--color-primary)"></i> &nbsp; ¿Qué información
                        muestra el Dashboard?
                    </button>
                </div>
                <div id="jefe-dashboard" class="collapse">
                    <div class="card-body">
                        <p>El <strong>Dashboard</strong> ofrece una vista ejecutiva del estado del área de mantenimiento.
                            Incluye:</p>
                        <ul>
                            <li><strong>Solicitudes por estado:</strong> cuántas están abiertas, en proceso, pendientes de
                                aprobación o finalizadas.</li>
                            <li><strong>Solicitudes por tipo:</strong> distribución entre especializadas, edilicias.</li>
                            <li><strong>Equipos con más solicitudes:</strong> identificá cuáles equipos generan más fallas.
                            </li>
                            <li><strong>Distribución por área:</strong> qué sectores de la planta generan más demanda de
                                mantenimiento.</li>
                            <li><strong>Evolución temporal:</strong> gráfico de solicitudes a lo largo del tiempo.</li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            Usá el Dashboard para tomar decisiones de planificación y priorizar recursos.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 6. Generar reportes PDF --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#jefe-reporte">
                        <i class="fa-solid fa-file-arrow-down" style="color:var(--color-info)"></i> &nbsp; ¿Cómo generar un
                        reporte PDF de solicitudes?
                    </button>
                </div>
                <div id="jefe-reporte" class="collapse">
                    <div class="card-body">
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá al listado de
                                    <strong>Solicitudes</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Marcá las casillas de verificación (<i
                                        class="fa-regular fa-square-check"></i>) de las solicitudes que querés incluir en el
                                    reporte.</span></li>
                            <li><span class="step-num">3</span><span>Hacé click en el botón <i
                                        class="fa-solid fa-file-arrow-down" style="color:var(--color-info)"></i> al pie del
                                    listado.</span></li>
                            <li><span class="step-num">4</span><span>Se descargará automáticamente un archivo
                                    <strong>PDF</strong> con el detalle de las solicitudes seleccionadas y su historial de
                                    estados.</span></li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            Podés usar filtros antes de seleccionar para generar reportes segmentados por área, técnico o
                            período de tiempo.
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endrole

        {{-- ========================================================
        SECCIÓN: ADMINISTRADOR
        ======================================================== --}}
        @role('Administrador')
        <div class="section-admin mt-4">

            <div class="card mt-4 mb-2">
                <div class="card-header">
                    <i class="fa-solid fa-shield-halved"></i> &nbsp; Guía para Administradores
                </div>
            </div>

            {{-- 1. Usuarios --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#adm-usuarios">
                        <i class="fa-solid fa-users" style="color:var(--color-primary)"></i> &nbsp; ¿Cómo crear y gestionar
                        usuarios?
                    </button>
                </div>
                <div id="adm-usuarios" class="collapse">
                    <div class="card-body">
                        <p>Los usuarios son las personas que acceden al sistema. Cada usuario debe estar vinculado a un
                            <strong>Empleado</strong> previamente registrado.
                        </p>

                        <h6 style="color:var(--color-primary)"><i class="fa-solid fa-plus agregar"></i> Crear un usuario
                            nuevo</h6>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá a <strong>Parámetros →
                                        Usuarios</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Hacé click en <strong>Nuevo Usuario</strong>.</span>
                            </li>
                            <li><span class="step-num">3</span><span>Seleccioná la <strong>persona</strong> (empleado) a la
                                    que le vas a crear el acceso.</span></li>
                            <li><span class="step-num">4</span><span>Completá el <strong>correo electrónico</strong> y la
                                    <strong>contraseña</strong> inicial.</span></li>
                            <li><span class="step-num">5</span><span>Guardá el usuario.</span></li>
                        </ul>

                        <h6 class="mt-3" style="color:#e67e22"><i class="fa-solid fa-trash-can eliminar"></i> Eliminar un
                            usuario</h6>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>En el listado de usuarios, hacé click en el ícono <i
                                        class="fa-solid fa-circle-xmark eliminar"></i>.</span></li>
                            <li><span class="step-num">2</span><span>Confirmá la eliminación en el mensaje de alerta. Esta
                                    acción <strong>no se puede deshacer</strong>.</span></li>
                        </ul>
                        <div class="warning-box">
                            <i class="fa-solid fa-triangle-exclamation" style="color:var(--color-danger)"></i>
                            Eliminar un usuario no elimina sus solicitudes históricas en el sistema.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Roles y permisos --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#adm-roles">
                        <i class="fa-solid fa-key" style="color:var(--color-accent)"></i> &nbsp; ¿Cómo asignar y revocar
                        roles a un usuario?
                    </button>
                </div>
                <div id="adm-roles" class="collapse">
                    <div class="card-body">
                        <p>Los <strong>roles</strong> determinan a qué módulos y funciones puede acceder cada usuario:</p>
                        <table class="table table-sm table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Rol</th>
                                    <th>Accesos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge badge-secondary">Empleado</span></td>
                                    <td>Crear y consultar sus propias solicitudes.</td>
                                </tr>
                                <tr>
                                    <td><span class="badge"
                                            style="background:#16a085;color:#fff">Empleado-Mantenimiento</span></td>
                                    <td>Ver y actualizar las solicitudes asignadas. Registrar avances y uso de repuestos.
                                    </td>
                                </tr>
                                <tr>
                                    <td><span class="badge" style="background:#e67e22;color:#fff">Jefe-Mantenimiento</span>
                                    </td>
                                    <td>Solicitudes, Equipos, Mantenimiento Programado, Dashboard.</td>
                                </tr>
                                <tr>
                                    <td><span class="badge badge-danger">Administrador</span></td>
                                    <td>Acceso completo: todo lo anterior + Parámetros, Usuarios, Roles, Backup.</td>
                                </tr>
                            </tbody>
                        </table>

                        <h6 class="mt-3" style="color:var(--color-success)"><i class="fa-solid fa-user-plus asignar"></i>
                            Asignar un rol</h6>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá a <strong>Parámetros →
                                        Usuarios</strong>.</span></li>
                            <li><span class="step-num">2</span><span>En la fila del usuario, hacé click en <strong>Asignar
                                        Rol</strong>.</span></li>
                            <li><span class="step-num">3</span><span>Seleccioná el rol del desplegable y confirmá.</span>
                            </li>
                        </ul>

                        <h6 class="mt-3" style="color:var(--color-danger)"><i class="fa-solid fa-user-minus eliminar"></i>
                            Revocar un rol</h6>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>En la fila del usuario, hacé click en <strong>Revocar
                                        Rol</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Seleccioná el rol que querés quitar y confirmá.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- 3. Empleados --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#adm-empleados">
                        <i class="fa-solid fa-id-badge" style="color:var(--color-primary)"></i> &nbsp; ¿Cómo registrar y
                        gestionar empleados?
                    </button>
                </div>
                <div id="adm-empleados" class="collapse">
                    <div class="card-body">
                        <p>Los <strong>Empleados</strong> son las personas físicas de la empresa. Un empleado debe estar
                            registrado antes de poder crear su usuario de acceso.</p>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá a <strong>Parámetros →
                                        Empleados</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Hacé click en <strong>Nuevo Empleado</strong>.</span>
                            </li>
                            <li><span class="step-num">3</span><span>Completá nombre, apellido y el <strong>Área</strong> a
                                    la que pertenece.</span></li>
                            <li><span class="step-num">4</span><span>Guardá el registro.</span></li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            El área del empleado determina en qué sector de la empresa trabajará. Verificá que el área
                            exista antes de crear el empleado.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 4. Áreas --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#adm-areas">
                        <i class="fa-solid fa-building" style="color:var(--color-primary)"></i> &nbsp; ¿Cómo gestionar
                        Áreas?
                    </button>
                </div>
                <div id="adm-areas" class="collapse">
                    <div class="card-body">
                        <p>Las <strong>Áreas</strong> representan los sectores o departamentos de la empresa. Son usadas en
                            empleados, localizaciones, equipos y solicitudes.</p>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá a <strong>Parámetros → Áreas</strong>.</span>
                            </li>
                            <li><span class="step-num">2</span><span>Hacé click en <strong>Nueva Área</strong>, ingresá el
                                    nombre y guardá.</span></li>
                            <li><span class="step-num">3</span><span>Para editar, usá el ícono de edición en la fila
                                    correspondiente.</span></li>
                        </ul>
                        <div class="warning-box">
                            <i class="fa-solid fa-triangle-exclamation" style="color:var(--color-danger)"></i>
                            No elimines un área que esté siendo utilizada por empleados, localizaciones o equipos, ya que
                            afectará los datos existentes.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 5. Localizaciones --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#adm-localizaciones">
                        <i class="fa-solid fa-map-marker-alt" style="color:var(--color-danger)"></i> &nbsp; ¿Cómo gestionar
                        Localizaciones?
                    </button>
                </div>
                <div id="adm-localizaciones" class="collapse">
                    <div class="card-body">
                        <p>Las <strong>Localizaciones</strong> son ubicaciones físicas dentro de un Área (por ejemplo:
                            Planta Baja, Piso 2, Depósito Norte). Son usadas en equipos y solicitudes para precisar dónde
                            ocurrió un problema.</p>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá a <strong>Parámetros →
                                        Localizaciones</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Hacé click en <strong>Nueva
                                        Localización</strong>.</span></li>
                            <li><span class="step-num">3</span><span>Ingresá el nombre y seleccioná el <strong>Área</strong>
                                    a la que pertenece.</span></li>
                            <li><span class="step-num">4</span><span>Guardá el registro.</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- 6. Tipos de equipos --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#adm-tipos">
                        <i class="fa-solid fa-cubes" style="color:var(--color-primary)"></i> &nbsp; ¿Cómo gestionar Tipos de
                        Equipos?
                    </button>
                </div>
                <div id="adm-tipos" class="collapse">
                    <div class="card-body">
                        <p>Los <strong>Tipos de Equipos</strong> categorizan los equipos del inventario (ej: Bomba, Motor,
                            Compresor, Generador, etc.).</p>
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá a <strong>Parámetros → Tipos de
                                        Equipos</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Creá, editá o eliminá tipos según las necesidades de la
                                    empresa.</span></li>
                            <li><span class="step-num">3</span><span>También podés asignar tipos específicos a equipos desde
                                    el listado de tipos.</span></li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- 7. Backup --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#adm-backup">
                        <i class="fa-solid fa-database" style="color:var(--color-info)"></i> &nbsp; ¿Cómo realizar un backup
                        de la base de datos?
                    </button>
                </div>
                <div id="adm-backup" class="collapse">
                    <div class="card-body">
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá a <strong>Parámetros → Descargar
                                        Backup</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Seleccioná el período o dejá la opción predeterminada
                                    para un backup completo.</span></li>
                            <li><span class="step-num">3</span><span>Presioná el botón <strong>Exportar</strong>.</span>
                            </li>
                            <li><span class="step-num">4</span><span>Se descargará un archivo <code>.sql</code> con el
                                    estado actual de la base de datos.</span></li>
                        </ul>
                        <div class="tip-box">
                            <i class="fa-solid fa-lightbulb" style="color:var(--color-accent)"></i>
                            <strong>Recomendación:</strong> Realizá backups periódicos (al menos semanal) y guardalos en un
                            lugar seguro fuera del servidor.
                        </div>
                    </div>
                </div>
            </div>

            {{-- 8. Restore --}}
            <div class="help-card card">
                <div class="card-header">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#adm-restore">
                        <i class="fa-solid fa-rotate-left" style="color:var(--color-danger)"></i> &nbsp; ¿Cómo restaurar un
                        backup?
                    </button>
                </div>
                <div id="adm-restore" class="collapse">
                    <div class="card-body">
                        <ul class="step-list">
                            <li><span class="step-num">1</span><span>Ingresá a <strong>Parámetros → Restaurar
                                        Backup</strong>.</span></li>
                            <li><span class="step-num">2</span><span>Hacé click en <strong>Seleccionar archivo</strong> y
                                    elegí el archivo <code>.sql</code> previamente descargado.</span></li>
                            <li><span class="step-num">3</span><span>Presioná <strong>Importar</strong> y confirmá la acción
                                    en el mensaje de alerta.</span></li>
                            <li><span class="step-num">4</span><span>Esperá a que el proceso finalice. <strong>No cierres la
                                        ventana</strong> durante la importación.</span></li>
                        </ul>
                        <div class="warning-box">
                            <i class="fa-solid fa-triangle-exclamation" style="color:var(--color-danger)"></i>
                            <strong>¡Atención crítica!</strong> Restaurar un backup <strong>reemplaza completamente</strong>
                            todos los datos actuales del sistema. Los cambios realizados después del backup se perderán de
                            forma <strong>irreversible</strong>. Solo realizá esta operación cuando sea estrictamente
                            necesario.
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @endrole

        {{-- ======================================================
        SECCIÓN DE CONTACTO (visible para todos los roles)
        ====================================================== --}}
        <div class="contact-box mt-4">
            <h5><i class="fa-solid fa-headset"></i> &nbsp; ¿Necesitás más ayuda?</h5>
            <p class="mb-1">Si esta guía no resuelve tu consulta, comunicate con el área de <strong>Sistemas</strong>.</p>
            <p class="mb-0" style="font-size:.9rem; opacity:.85;">
                <i class="fa-solid fa-circle-info"></i> &nbsp;
                También podés consultar con tu <strong>Jefe de Mantenimiento</strong> para dudas operativas del sistema.
            </p>
        </div>

    </div>
@endsection