<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupController extends Controller
{
    public function __construct()
    {
        try {
            if (Schema::hasTable('users')) {
                $this->middleware(['auth', 'role:Administrador']);
            }
        } catch (\Exception $e) {
            // Si falla conexión DB → modo instalación
        }
    }

    public function indexBackup()
    {
        return view('backup.index');
    }

    public function indexRestore()
    {
        return view('restore.index');
    }

    // ==============================
    // EXPORTAR BACKUP
    // ==============================
    public function exportBackup()
    {
        try {
            $database = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $host     = config('database.connections.mysql.host');

            $mysqldump = env('MYSQLDUMP_PATH', 'mysqldump');

            $backupPath = storage_path('app/backups');
            if (!file_exists($backupPath)) {
                mkdir($backupPath, 0755, true);
            }

            $filename = "{$database}_" . date('Y_m_d_His') . ".sql";
            $filePath = $backupPath . '/' . $filename;

            $command = [
                $mysqldump,
                "-h{$host}",
                "-u{$username}",
            ];

            if (!empty($password)) {
                $command[] = "-p{$password}";
            }

            $command[] = $database;
            $command[] = "--result-file={$filePath}";

            $process = new Process($command);
            $process->setTimeout(3600);
            $process->mustRun();

            return response()->download($filePath)->deleteFileAfterSend(true);

        } catch (ProcessFailedException $e) {
            return back()->with('error', 'Error al exportar: ' . $e->getMessage());
        }
    }

    // ==============================
    // IMPORTAR BACKUP
    // ==============================
    public function importBackup(Request $request)
    {
        $request->validate([
            'backup_file' => 'required|file'
        ]);

        try {

            $database = config('database.connections.mysql.database');
            $username = config('database.connections.mysql.username');
            $password = config('database.connections.mysql.password');
            $host     = config('database.connections.mysql.host');

            $mysql = env('MYSQL_PATH', 'mysql');

            // Guardar archivo temporalmente
            $file = $request->file('backup_file');
            $path = $file->store('backups');
            $fullPath = storage_path('app/' . $path);

            // ==============================
            // 1️⃣ BORRAR TODAS LAS TABLAS
            // ==============================

            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            $tables = DB::select('SHOW TABLES');
            $databaseKey = 'Tables_in_' . $database;

            foreach ($tables as $table) {
                $tableName = $table->$databaseKey;
                DB::statement("DROP TABLE IF EXISTS `$tableName`");
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            // ==============================
            // 2️⃣ IMPORTAR BACKUP
            // ==============================

            $command = [
                $mysql,
                "-h{$host}",
                "-u{$username}",
            ];

            if (!empty($password)) {
                $command[] = "-p{$password}";
            }

            $command[] = $database;

            $process = new Process($command);
            $process->setInput(file_get_contents($fullPath));
            $process->setTimeout(3600);
            $process->mustRun();

            // borrar archivo temporal
            Storage::delete($path);

            return redirect()->route('restore')
                ->with('success', 'Base de datos restaurada correctamente.');

        } catch (ProcessFailedException $e) {

            return back()->with('error', 'Error al restaurar: ' . $e->getMessage());
        }
    }
}