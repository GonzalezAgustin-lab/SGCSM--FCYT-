<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Tipo_Equipo;
use App\User;
Use Session;
use DB;


class Tipo_EquipoController extends Controller
{
    public function index(Request $request)
    {
        $tipos_equipos = Tipo_Equipo::Index($request->get('tipos_equipos'))
        ->paginate(20);

        return view ('tipos_equipos.index', array('tipos_equipos'=>$tipos_equipos));
    }

    public function show_store_tipo_equipo()
    {
        return view('tipos_equipos.create');       
    }

    public function store_tipo_equipo(Request $request)
    {        
        $tipo_equipo = new Tipo_Equipo;
        $tipo_equipo->nombre = $request['nombre'];
        $tipo_equipo->save();

        Session::flash('message','Tipo agregado con éxito');
        Session::flash('alert-class', 'alert-success');
        return redirect ('tipos_equipos');
    }

    public function show_update_tipo_equipo($id)
    {
        $tipo_equipo = Tipo_Equipo::tipoEquipoSeleccionado($id); 
        return view('tipos_equipos.update', ['tipo_equipo' => $tipo_equipo]);       
    }

    public function update_tipo_equipo(Request $request)
    {
        $tipo_equipo = Tipo_Equipo::updateTipoEquipo($request['id'], $request['nombre']); 
        Session::flash('message','Tipo modificado con éxito');
        Session::flash('alert-class', 'alert-success');
        return redirect('tipos_equipos');
    }

    public function show_assing_tipo_equipo($id)
    {
        $tipo_equipo = Tipo_Equipo::find($id);
        return view('tipos_equipos.assing', [
            'tipo_equipo' => $tipo_equipo
        ]);       
    }
}
