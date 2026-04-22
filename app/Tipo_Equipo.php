<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Tipo_Equipo extends Model
{
    public $table = "tipos_equipos";
    public $timestamps = false;
    public function scopeIndex ($query){
        return $query->select('tipos_equipos.id as id', 'tipos_equipos.nombre as nombre');
    }
    public static function tipoEquipoSeleccionado($id){
        return Tipo_Equipo::select('tipos_equipos.id as id', 'tipos_equipos.nombre as nombre')
        ->where('tipos_equipos.id', $id)
        ->first();
    }
    public static function updateTipoEquipo($id, $nombre){
        Tipo_Equipo::where('tipos_equipos.id',$id)
        ->update([
            'nombre' => $nombre
        ]);    
    }
}

