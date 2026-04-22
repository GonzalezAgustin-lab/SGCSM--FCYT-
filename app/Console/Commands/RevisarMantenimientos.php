<?php

namespace App\Console\Commands;


use App\Mail\MantenimientoNotification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Command;
use Carbon\Carbon; 
use DB;

class RevisarMantenimientos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mantenimientos:revisar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa los mantenimientos programados y envía correos si es necesario';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hoy = Carbon::today();

        // Consulta mantenimientos programados para hoy
        $mantenimientos = DB::table('mantenimientos_programados')
            ->leftjoin('frecuencias', 'mantenimientos_programados.frecuencia', '=', 'frecuencias.id')
            ->where(function($query) use ($hoy) {
                $query->where(function($subquery) use ($hoy) {
                    // Si ultima_fecha_mantenimiento es null, usamos directamente fecha_de_inicio
                    $subquery->whereNull('ultima_fecha_mantenimiento')
                            ->whereDate('fecha_de_inicio', $hoy);
                })->orWhere(function($subquery) use ($hoy) {
                    // Si ultima_fecha_mantenimiento no es null, le sumamos los días de la frecuencia
                    $subquery->whereNotNull('ultima_fecha_mantenimiento')
                            ->whereRaw('DATE_ADD(ultima_fecha_mantenimiento, INTERVAL frecuencias.dias DAY) = ?', [$hoy]);
                });
            })
            ->where('mantenimientos_programados.activo', '=', 1)
            ->select('mantenimientos_programados.id as id',
                'mantenimientos_programados.equipo as equipo',
                'mantenimientos_programados.nombre as nombre',
                'frecuencias.nombre as frecuencia',
                'mantenimientos_programados.descripcion as descripcion',
                'mantenimientos_programados.ultima_fecha_mantenimiento as ultima_fecha_mantenimiento',
                'mantenimientos_programados.fecha_de_inicio as fecha_de_inicio')
            ->get();

        $correosJefeMant = DB::table('model_has_roles')
            ->leftjoin('roles', 'roles.id', 'model_has_roles.role_id')
            ->leftjoin('users', 'users.id', 'model_has_roles.model_id')
            ->where('roles.name', '=', 'Jefe-Mantenimiento')
            ->select('users.email')
            ->get();

        foreach ($mantenimientos as $mantenimiento) {

            // Actualizamos ultima_fecha_mantenimiento para los mantenimientos seleccionados
            DB::table('mantenimientos_programados')
            ->where('id', $mantenimiento->id)
            ->update(['ultima_fecha_mantenimiento' => $hoy]);

            // Lógica para enviar el correo
            /*foreach ($correosJefeMant as $correoJefeMant){
                Mail::to($correoJefeMant)->send(new MantenimientoNotification($mantenimiento));
            }*/
        }

        $this->info('Correos de mantenimiento enviados.');
    }
}
