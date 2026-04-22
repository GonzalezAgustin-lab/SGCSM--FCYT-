<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
public function run(): void
    {
        $areas = [
            ['id_a' => 'aaa', 'nombre_a' => 'Administracion remota 1'],
            ['id_a' => 'aco', 'nombre_a' => 'Acondicionamiento'],
            ['id_a' => 'act', 'nombre_a' => 'Acondicionamiento turno tarde'],
            ['id_a' => 'adm', 'nombre_a' => 'Administracion'],
            ['id_a' => 'ari', 'nombre_a' => 'Asuntos Regulatorios Internacionales'],
            ['id_a' => 'asr', 'nombre_a' => 'Asuntos Regulatorios'],
            ['id_a' => 'ATN', 'nombre_a' => 'Acondicionamiento Turno Noche'],
            ['id_a' => 'cca', 'nombre_a' => 'Control de Calidad'],
            ['id_a' => 'coe', 'nombre_a' => 'Comercio Exterior'],
            ['id_a' => 'com', 'nombre_a' => 'Compras'],
            ['id_a' => 'con', 'nombre_a' => 'Contable'],
            ['id_a' => 'cos', 'nombre_a' => 'Costos'],
            ['id_a' => 'dee', 'nombre_a' => 'Depósito Expedición'],
            ['id_a' => 'der', 'nombre_a' => 'Depósito Recepción'],
            ['id_a' => 'des', 'nombre_a' => 'Desarrollo'],
            ['id_a' => 'dir', 'nombre_a' => 'Directorio'],
            ['id_a' => 'dis', 'nombre_a' => 'Diseño'],
            ['id_a' => 'dit', 'nombre_a' => 'Dirección Técnica'],
            ['id_a' => 'dmp', 'nombre_a' => 'Deposito materia prima aprobada'],
            ['id_a' => 'dse', 'nombre_a' => 'Depósito Semielaborado'],
            ['id_a' => 'ext', 'nombre_a' => 'Exterior'],
            ['id_a' => 'fac', 'nombre_a' => 'Facturación'],
            ['id_a' => 'gca', 'nombre_a' => 'Garantía de Calidad'],
            ['id_a' => 'GPL', 'nombre_a' => 'Gerencia de Planta'],
            ['id_a' => 'gpr', 'nombre_a' => 'Gerencia producción'],
            ['id_a' => 'GSP', 'nombre_a' => 'GERENCIA SUPPLY CHAIN'],
            ['id_a' => 'gua', 'nombre_a' => 'Guardia'],
            ['id_a' => 'ind', 'nombre_a' => 'Ingeniería Industrial'],
            ['id_a' => 'ing', 'nombre_a' => 'Ingeniería'],
            ['id_a' => 'lnt', 'nombre_a' => 'Liq. y S. Solidos No Estériles T. Tarde'],
            ['id_a' => 'lse', 'nombre_a' => 'Liq. y S. Solidos Estériles'],
            ['id_a' => 'lsn', 'nombre_a' => 'Liq. y S. Solidos No Estériles'],
            ['id_a' => 'lst', 'nombre_a' => 'Liq. y S. Solidos Estériles T. Tarde'],
            ['id_a' => 'mae', 'nombre_a' => 'Maestranza'],
            ['id_a' => 'man', 'nombre_a' => 'Mantenimiento'],
            ['id_a' => 'mar', 'nombre_a' => 'Marketing'],
            ['id_a' => 'med', 'nombre_a' => 'Consultorio Medico'],
            ['id_a' => 'mic', 'nombre_a' => 'Microbiología'],
            ['id_a' => 'oft', 'nombre_a' => 'Oftalmicos'],
            ['id_a' => 'ope', 'nombre_a' => 'Operaciones'],
            ['id_a' => 'pag', 'nombre_a' => 'Pagos'],
            ['id_a' => 'per', 'nombre_a' => 'Personal'],
            ['id_a' => 'pes', 'nombre_a' => 'Pesadas'],
            ['id_a' => 'pex', 'nombre_a' => 'Playon exterior'],
            ['id_a' => 'pla', 'nombre_a' => 'Planificación'],
            ['id_a' => 'pre', 'nombre_a' => 'Presidencia'],
            ['id_a' => 'pro', 'nombre_a' => 'Producción'],
            ['id_a' => 'rec', 'nombre_a' => 'Recepción'],
            ['id_a' => 'reh', 'nombre_a' => 'Recursos Humanos'],
            ['id_a' => 'sis', 'nombre_a' => 'Sistemas'],
            ['id_a' => 'sm1', 'nombre_a' => 'Sala de máquinas 1'],
            ['id_a' => 'sm2', 'nombre_a' => 'Sala de máquinas 2'],
            ['id_a' => 'sm3', 'nombre_a' => 'Sala de máquinas 3'],
            ['id_a' => 'sol', 'nombre_a' => 'Solidos'],
            ['id_a' => 'sot', 'nombre_a' => 'Solidos turno tarde'],
            ['id_a' => 'srs', 'nombre_a' => 'Sala de Reuniones'],
            ['id_a' => 'tt1', 'nombre_a' => 'Terraza técnica 1'],
            ['id_a' => 'tt2', 'nombre_a' => 'Terraza técnica 2'],
            ['id_a' => 'val', 'nombre_a' => 'Validaciones y Calificaciones'],
            ['id_a' => 'ven', 'nombre_a' => 'Ventas'],
            ['id_a' => 'vic', 'nombre_a' => 'Vicepresidencia'],
        ];

        DB::table('area')->insert($areas);
    }
}
