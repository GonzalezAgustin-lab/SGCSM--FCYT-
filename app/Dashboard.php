<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dashboard extends Model{
    use SoftDeletes;
    public $timestamps = false;
    public function scopeEquiposXArea($query)
    {
        return DB::table('equipos_mant')
        ->join('area', 'equipos_mant.id_area', '=', 'area.id_a')
        ->select('area.nombre_a', DB::raw('COUNT(equipos_mant.id_area) as total_equipos'))
        ->groupBy('area.nombre_a')
        ->get();
    }

    public function scopeSolicitudesXTipo($query)
    {
        return DB::table('solicitudes')
        ->join('tipo_solicitudes', 'solicitudes.id_tipo_solicitud', '=', 'tipo_solicitudes.id')
        ->select('tipo_solicitudes.nombre', DB::raw('COUNT(solicitudes.id) as total_solicitudes'))
        ->groupBy('tipo_solicitudes.nombre')
        ->get();
    }

    public function scopeSolicitudesXAreaEspecializado($query)
    {
        return DB::table('solicitudes')
        ->join('equipos_mant', 'solicitudes.id_equipo', '=', 'equipos_mant.id')
        ->join('area', 'equipos_mant.id_area', '=', 'area.id_a')
        ->select('area.nombre_a', DB::raw('COUNT(solicitudes.id) as total_solicitudes'))
        ->groupBy('area.nombre_a')
        ->get();
    }

    public function scopeSolicitudesXAreaEdilicio($query)
    {
        return DB::table('solicitudes')
        ->join('localizaciones', 'solicitudes.id_localizacion_edilicio', '=', 'localizaciones.id')
        ->join('area', 'localizaciones.id_area', '=', 'area.id_a')
        ->select('area.nombre_a', DB::raw('COUNT(solicitudes.id) as total_solicitudes'))
        ->groupBy('area.nombre_a')
        ->get();
    }

}
?>
