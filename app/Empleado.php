<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table='personas';
    protected $primaryKey = 'id_p';
    
    public function scopeRelacion($query){
        return $query->leftjoin('area', 'area.id_a', 'personas.area')
        ->select(
            'personas.id_p as id_p',
            'personas.nombre_p as nombre_p',
            'personas.apellido as apellido',
            'personas.dni as dni',
            'personas.fe_ing as fe_ing',
            'personas.fe_nac as fe_nac',
            'personas.activo as activo',
            'personas.jefe as jefe',
            'area.id_a as area',
            'area.nombre_a as nombre_a')
        ->orderByRaw('personas.activo DESC, personas.apellido ASC');
    }

    public function scopeBusca_personas($query, $persona){
        return $query = DB::table('personas')
        ->leftJoin('jefe_area', 'personas.area', '=', 'jefe_area.area')
        ->where('personas.activo', 1)
        ->where('jefe_area.jefe', $persona)
        ->where('personas.id_p', '!=', $persona)
        ->select('personas.id_p', 'personas.nombre_p', 'personas.apellido')
        ->orderBy('apellido', 'asc')->get();
    }
    
    public static function showAreaXJefeUpdate($id_ja) {
        return self::query()
            ->leftJoin('jefe_area', 'jefe_area.jefe', '=', 'personas.id_p')
            ->leftJoin('area', 'area.id_a', '=', 'jefe_area.area')
            ->where('jefe_area.jefe', '=', $id_ja)
            ->select('jefe_area.id_ja as id_ja', 'area.nombre_a as nombreArea', 'jefe_area.jefe as idJefe')
            ->get();
    }

    public static function selectAreas() {
        return DB::table('area')->get();
    }

    public static function selectJefeXArea() {
        return DB::table('jefe_area')->get(); 
    }
}
    