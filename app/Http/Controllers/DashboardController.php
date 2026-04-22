<?php

namespace App\Http\Controllers;

use Krucas\Notification\Middleware\NotificationMiddleware;
use Illuminate\Routing\Controller;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use App\Dashboard;
Use Session;
use Auth;
use DB;

class DashboardController extends Controller{

    public function index(Request $request){
        $solicitudesPorTipo = Dashboard::SolicitudesXTipo();
        $equiposPorArea = Dashboard::EquiposXArea();
        $solicitudesPorAreaEspecializado = Dashboard::SolicitudesXAreaEspecializado();
        $solicitudesPorAreaEdilicio = Dashboard::SolicitudesXAreaEdilicio();
        return view('dashboards.index', compact('solicitudesPorTipo', 'equiposPorArea', 'solicitudesPorAreaEspecializado', 'solicitudesPorAreaEdilicio'));
    }
}