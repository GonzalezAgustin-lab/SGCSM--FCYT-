<?php

namespace App\Http\Controllers;

use App\Novedad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.mantenimiento');
    }

    public function parametros_mantenimiento()
    {
        return view('home.parametros_mantenimiento');
    }

}
