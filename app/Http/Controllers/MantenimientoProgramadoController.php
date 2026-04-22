<?php

namespace App\Http\Controllers;

use App\MantenimientoProgramado;
use Illuminate\Http\Request;
Use Session;
use DB;

class MantenimientoProgramadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mantenimientos_programados_query = MantenimientoProgramado::filterByRequest($request);
        $mantenimientos_programados = $mantenimientos_programados_query->paginate(20);

        $frecuencias = MantenimientoProgramado::getFrecuencias();

        return view('mantenimientoProgramado.index', [
            'mantenimientos_programados' => $mantenimientos_programados,
            'frecuencias' => $frecuencias,
            'id_mant_prog' => $request->get('id_mant_prog'),
            'nombre' => $request->get('nombre'),
            'id_equipo' => $request->get('id_equipo'),
            'id_frecuencia' => $request->get('id_frecuencia'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMantenimientoProgramadoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MantenimientoProgramado $mantenimientoProgramado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MantenimientoProgramado $mantenimientoProgramado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MantenimientoProgramado $mantenimientoProgramado)
    {
        //
    }

    public function show_store_mant_prog(){
        return view('mantenimientoProgramado.create');       
    }

    public function show_mostrar_equipos_mant_prog(){
        $equipos = MantenimientoProgramado::getEquiposMantenimientoConLocalizacionYArea();

        return view('mantenimientoProgramado.show_equipo', ['equipos' => $equipos,]);
    }

    public function select_tablas_mant_prog(){
        return [MantenimientoProgramado::getFrecuencias(),
        MantenimientoProgramado::getEquiposMantenimiento()];
    }   

    public function store_mant_prog(Request $request){

        $activo = ($request['activo'] == 'on') ? 1 : 0;

        $mantenimientoProgramado = new MantenimientoProgramado;
        $mantenimientoProgramado->nombre = $request['nombre'];
        $mantenimientoProgramado->equipo = $request['equipo'];
        $mantenimientoProgramado->frecuencia = $request['frecuencia'];
        $mantenimientoProgramado->ultima_fecha_mantenimiento = $request['ultima_fecha_mantenimiento'];
        $mantenimientoProgramado->fecha_de_inicio = $request['fecha_de_inicio'];
        $mantenimientoProgramado->descripcion = $request['descripcion'];
        $mantenimientoProgramado->activo = $activo;

        $mantenimientoProgramado->save();

        Session::flash('message','Mantenimiento agregado con éxito');
        Session::flash('alert-class', 'alert-success');
        return redirect ('mantenimientoProgramado');
    }

    public function getMantProg($idMantProg){
        return DB::table('mantenimientos_programados')
            ->leftjoin('frecuencias', 'frecuencias.id', 'mantenimientos_programados.frecuencia')
            ->select('mantenimientos_programados.id as id',
                'mantenimientos_programados.nombre as nombre',
                'mantenimientos_programados.equipo as equipo',
                'mantenimientos_programados.descripcion as descripcion',
                'mantenimientos_programados.activo as activo',
                'mantenimientos_programados.ultima_fecha_mantenimiento as ult_fech_mant',
                'mantenimientos_programados.fecha_de_inicio as fecha_de_inicio',
                'mantenimientos_programados.created_at as fecha_de_creacion',
                'mantenimientos_programados.updated_at as fecha_de_actualizacion',
                'frecuencias.id as frecuencia')
            ->where('mantenimientos_programados.id', $idMantProg)
            ->orderBy('mantenimientos_programados.id', 'asc')
            ->limit(1)
            ->get();
    }

    public function show_edit_mant_prog($id){
        return view('mantenimientoProgramado.edit', ['mant_prev' => $id]);
    }

    public function edit_mant_prog(Request $request){

        MantenimientoProgramado::editMantProg($request['idMantProg1'], $request['nombre1'], $request['descripcion1'], $request['equipo1'], $request['fecha_de_inicio1'], $request['frecuencia1'], $request['activo1']);
        
        Session::flash('message','Mantenimiento editado con éxito');
        Session::flash('alert-class', 'alert-success');
        return redirect ('mantenimientoProgramado');
    }
}