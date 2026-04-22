<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Persona;
Use Redirect;
Use Session;
use Auth;
use DB;

class UsuarioController extends Controller
{
    public function index (Request $request){

        $usuarios = DB::table('users')
        ->select('users.id as id', 'users.name as nombre_usuario','users.email as email_usuario')
        ->orderBy('users.name','asc')
        ->get();

        $roles = DB::table('model_has_roles')
        ->leftjoin('roles','model_has_roles.role_id','roles.id')
        ->leftjoin('users','model_has_roles.model_id','users.id')
        ->select('roles.name as nombre_rol','roles.id as id_rol','users.id as id_usuario')
        ->get();

        $permisos = DB::table('role_has_permissions')
        ->leftjoin('permissions','role_has_permissions.permission_id','permissions.id')
        ->leftjoin('roles','role_has_permissions.role_id','roles.id')
        ->select('role_has_permissions.role_id as rol', 'permissions.name as nombre_permiso')
        ->get();

        return view ('usuarios.usuarios', array('usuarios'=>$usuarios, 'permisos'=>$permisos, 'roles'=>$roles));
    }

    public function create_usuario(Request $request)
    {
        Auth::logout();

        return redirect('/register');
    }

    public function destroy_usuario($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return redirect('/usuarios');
        }

        // Si el usuario tiene rol Administrador
        if ($usuario->hasRole('Administrador')) {

            // Contar cuantos administradores hay
            $cantidadAdmins = User::role('Administrador')->count();

            if ($cantidadAdmins <= 1) {
                Session::flash('message','No se puede eliminar el último administrador del sistema.');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/usuarios');
            }
        }

        // Desvincular persona
        DB::table('personas')
            ->where('usuario', $id)
            ->update(['usuario' => null]);

        $usuario->delete();

        Session::flash('message','Usuario eliminado con éxito');
        Session::flash('alert-class', 'alert-success');

        return redirect('/usuarios');
    }

    public function asignar_rol(Request $request)
        {
        $usuario = User::find($request['id']);

        // Buscar el rol por su ID
        $rol = Role::find($request['rol']);

        if ($rol) {
            // Asignar el rol al usuario
            $usuario->assignRole($rol->name);

            Session::flash('message','Rol asignado con éxito');
            Session::flash('alert-class', 'alert-success');
        } else {
            // Manejar el caso cuando el rol no existe
            Session::flash('message','El rol no existe');
            Session::flash('alert-class', 'alert-danger');
        }
        return redirect('/usuarios');
    }


    public function revocar_rol(Request $request)
    {
        $usuario = User::find($request['id']);
        $rol = Role::find($request['rol']);

        if (!$rol) {
            Session::flash('message','El rol no existe');
            Session::flash('alert-class', 'alert-danger');
            return redirect('/usuarios');
        }

        // Si el rol a revocar es Administrador
        if ($rol->name == 'Administrador' && $usuario->hasRole('Administrador')) {

            $cantidadAdmins = User::role('Administrador')->count();

            if ($cantidadAdmins <= 1) {
                Session::flash('message','No se puede revocar el rol al único administrador del sistema.');
                Session::flash('alert-class', 'alert-danger');
                return redirect('/usuarios');
            }
        }

        $usuario->removeRole($rol->name);

        Session::flash('message','Rol revocado con éxito');
        Session::flash('alert-class', 'alert-success');

        return redirect('/usuarios');
    }

    public function store_rol(Request $request){
        $role = Role::create(['name' => $request['nombre_rol']]);
        Session::flash('message','Rol agregado con éxito');
        Session::flash('alert-class', 'alert-success');
        return redirect('/usuarios');
    }

    public function store_permiso(Request $request){
        $permiso = Permission::create(['name'=> $request['nombre_permiso']]);
        Session::flash('message','Permiso agregado con éxito');
        Session::flash('alert-class', 'alert-success');
        return redirect('/usuarios');
    }

    public function store_usuario(Request $request){
        /*no importa que si se usa nombre_p o correo,
        ambos tiene el valor de la id de la persona para poder enlazar los dos select*/
        $nombre = DB::table('personas')->where('personas.id_p', $request['nombre_p'])->value('nombre_p');
        $apellido = DB::table('personas')->where('personas.id_p', $request['nombre_p'])->value('apellido');
        $correo = DB::table('personas')->where('personas.id_p', $request['correo'])->value('correo');

        $usuario = User::create(['name'=>$nombre.' '.$apellido, 'email'=>$correo,
        'password'=> Hash::make($request['password'])]);

        $id_user = DB::table('users')->where('users.email', $correo)->value('id');

        $persona = DB::table('personas')
        ->where('personas.id_p',$request['nombre_p']) //nombre_p contine id
        ->update([
            'usuario' => $id_user
        ]);      

        Session::flash('message','Usuario agregado con éxito');
        Session::flash('alert-class', 'alert-success');
        return redirect('/usuarios');
    }

    public function select_personas()
    {
        return DB::table('personas')
        ->where('usuario', null)
        ->whereNotNull('correo')
        ->where('activo', 1)
        ->orderBy('nombre_p','asc')
        ->get();
    }
    
    public function select_roles($id)
    {
        $aux1 = DB::table('roles')
        ->leftjoin('model_has_roles','roles.id','model_has_roles.role_id')
        ->where('model_has_roles.model_id',$id)
        ->select('roles.name as name')
        ->get();

        if(count($aux1)==0)
        {
            return DB::table('roles')->get();
        }
        else 
        {
            foreach ($aux1 as $aux) 
            {
                $data[] = $aux->name;
            }
            return DB::table('roles')->whereNotIn('roles.name',$data)->orderBy('name','asc')->select('id','name')->get();
        }
    }

    public function select_revocar_roles($id)
    {
        return DB::table('roles')
        ->leftjoin('model_has_roles','roles.id','model_has_roles.role_id')
        ->where('model_has_roles.model_id',$id)
        ->select('id','name')
        ->get();
    }
}
