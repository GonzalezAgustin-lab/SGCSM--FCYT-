<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;

class MantenimientoProgramado extends Model
{
    public $table = "mantenimientos_programados";

    public function scopeFilterByRequest($query, $request)
    {
        return $query->ID($request->get('id_mant_prog'))
                    ->Equipo($request->get('id_equipo'))
                    ->Titulo($request->get('nombre'))
                    ->Relaciones_index($request->get('id_frecuencia'));
    }
    public function scopeID($query, $id_mant_prog){
        if($id_mant_prog){
            return $query -> where('mantenimientos_programados.id','LIKE',"%$id_mant_prog%");
        }
    }
    public function scopeTitulo($query, $nombre){
        if($nombre){
            return $query -> where('mantenimientos_programados.nombre','LIKE',"%$nombre%");
        }
    }
    public  function scopeEquipo ($query, $id_equipo){
    	if($id_equipo){
    	    return $query -> where('mantenimientos_programados.equipo','LIKE', "%$id_equipo%");
    	}
    }
    public function scopeRelaciones_index($query, $id_frecuencia){
        $query->leftjoin('frecuencias', 'frecuencias.id', 'mantenimientos_programados.frecuencia')
        ->select('mantenimientos_programados.id as id',
            'mantenimientos_programados.nombre as nombre',
            'mantenimientos_programados.equipo as equipo',
            'mantenimientos_programados.descripcion as descripcion',
            'mantenimientos_programados.activo as activo',
            'mantenimientos_programados.ultima_fecha_mantenimiento as ult_fech_mant',
            'mantenimientos_programados.fecha_de_inicio as fecha_de_inicio',
            'mantenimientos_programados.created_at as fecha_de_creacion',
            'mantenimientos_programados.updated_at as fecha_de_actualizacion',
            'frecuencias.nombre as frecuencia');

        if ($id_frecuencia != 0) {
            $query->where('mantenimientos_programados.frecuencia', $id_frecuencia);
        }
        
        return $query;
    }

    public static function getFrecuencias(){
        return DB::table('frecuencias')->get();
    }

    public static function getEquiposMantenimiento(){
        return DB::table('equipos_mant')->get();
    }

    public static function editMantProg($id, $nombre, $descripcion, $equipo, $fecha_de_inicio, $frecuencia, $activo){
        $activoAux;

        if($activo == "on"){
            $activoAux = 1;
        }else {
            $activoAux = 0;
        }
        //dd($activo ,$activoAux);
        DB::table('mantenimientos_programados')
            ->where('mantenimientos_programados.id', $id)
            ->update([
                'nombre' => $nombre, 
                'descripcion' => $descripcion, 
                'equipo' => $equipo, 
                'fecha_de_inicio' => $fecha_de_inicio,
                'frecuencia' => $frecuencia,
                'ultima_fecha_mantenimiento' => null,
                'activo' => $activoAux]);

    }

    public static function getEquiposMantenimientoConLocalizacionYArea(){
        return DB::table('equipos_mant')
        ->leftJoin('localizaciones', 'localizaciones.id', 'equipos_mant.id_localizacion')
        ->leftJoin('area', 'area.id_a', 'equipos_mant.id_area')
        ->select('equipos_mant.id as id', 'equipos_mant.marca as marca', 'equipos_mant.modelo as modelo', 'equipos_mant.descripcion as descripcion',
        'localizaciones.nombre as localizacion', 'area.nombre_a as area')
        ->orderBy('id', 'asc')
        ->get();
    }
}
