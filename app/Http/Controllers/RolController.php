<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Persona;
use App\User;
Use Redirect;
Use Session;
use Auth;
use DB;

class RolController extends Controller{

    public function index (Request $request){
        $roles = DB::table('roles')
        ->select('roles.name as nombre_rol','roles.id as id_rol')
        ->orderBy('roles.name','asc')
        ->get();

        $permisos = DB::table('role_has_permissions')
        ->leftjoin('permissions','role_has_permissions.permission_id','permissions.id')
        ->leftjoin('roles','role_has_permissions.role_id','roles.id')
        ->select('role_has_permissions.role_id as rol', 'permissions.name as nombre_permiso')
        ->get();

        return view ('roles.roles', array('permisos'=>$permisos, 'roles'=>$roles));
    }

    public function store_rol(Request $request){
        $aux = DB::table('roles')->where('roles.name',$request['nombre_rol'])->get();

        if(count($aux)==0){
            $role = Role::create(['name' => $request['nombre_rol']]);
            Session::flash('message','Rol agregado con éxito');
            Session::flash('alert-class', 'alert-success');
            return redirect('/roles');
        }
        else{
            Session::flash('message','Rol ingresado ya existe');
            Session::flash('alert-class', 'alert-warning');
            return redirect()->back();	
        }
    }

    /*public function store_permiso(Request $request){
        $aux = DB::table('permissions')->where('permissions.name',$request['nombre_permiso'])->get();

        if(count($aux)==0){
            $permiso = Permission::create(['name'=> $request['nombre_permiso']]);
            Session::flash('message','Permiso agregado con éxito');
            Session::flash('alert-class', 'alert-success');
            return redirect()->back();
        }
        else{
            Session::flash('message','Permiso ingresado ya existe');
            Session::flash('alert-class', 'alert-warning');
            return redirect()->back();	
        }
    }*/

    public function asignar_permiso(Request $request)
    {
        $rol = Role::find($request['id']);

        if ($rol->name == 'Administrador') {
            Session::flash('message','El rol Administrador ya posee todos los permisos.');
            Session::flash('alert-class', 'alert-warning');
            return redirect('/roles');
        }

        $rol->givePermissionTo($request['permiso']);

        Session::flash('message','Permiso asignado con éxito');
        Session::flash('alert-class', 'alert-success');

        return redirect('/roles');
    }

    public function revocar_permiso(Request $request)
    {
        $rol = Role::find($request['id']);

        if (!$rol) {
            return redirect('/roles');
        }

        // Bloquear si es Administrador
        if ($rol->name == 'Administrador') {

            Session::flash('message','No se pueden revocar permisos al rol Administrador.');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/roles');
        }

        $permiso = Permission::findById($request['permiso']);

        $rol->revokePermissionTo($permiso);

        Session::flash('message','Permiso revocado con éxito');
        Session::flash('alert-class', 'alert-success');

        return redirect('/roles');
    }

    public function select_permiso($id){
        $aux1 = DB::table('permissions')
        ->leftjoin('role_has_permissions','permissions.id','role_has_permissions.permission_id')
        ->where('role_has_permissions.role_id',$id)
        ->select('permissions.name as name')
        ->get();

        if(count($aux1)==0){
            return DB::table('permissions')->get();
        }
        else {
            foreach ($aux1 as $aux) {
                $data[] = $aux->name;
            }
            return DB::table('permissions')->whereNotIn('permissions.name',$data)->orderBy('name','asc')->select('id','name')->get();
        }
    }

    public function select_revocar_permiso($id){
        return  DB::table('permissions')
            ->leftjoin('role_has_permissions','permissions.id','role_has_permissions.permission_id')
            ->where('role_has_permissions.role_id',$id)
            ->select('id','name')
            ->get();
    }
}