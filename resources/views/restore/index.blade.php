@extends('restore.layouts.layout')
@section('content')

@if(Session::has('message'))
  <div class="container" id="div.alert">
    <div class="row">
      <div class="col-1"></div>
      <div class="alert {{Session::get('alert-class')}} col-10 text-center" role="alert">
        {{Session::get('message')}}
      </div>
    </div>
  </div>
@endif

<div class="container text-center">
    <br><br><br>
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form id="backupForm" action="{{ route('backup.import') }}" method="POST" enctype="multipart/form-data" class="form-inline d-flex flex-column align-items-center">
                @csrf
                
                <div class="mb-3">
                    <label for="backupFile" class="form-label">
                        <strong>Seleccionar archivo de respaldo:</strong>
                    </label>
                    <br>
                    <input type="file" name="backup_file" id="backupFile" accept=".sql" required class="form-control">
                    
                    @if ($errors->has('backup_file'))
                        <div class="alert alert-danger mt-2">
                            {{ $errors->first('backup_file') }}
                        </div>
                    @endif
                </div>
                
                <button type="submit" class="btn btn-primary mt-4">
                    <h3 class="m-0" style="color: white">Restaurar datos</h3>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    //Duracion de alerta
    $("solicitud").ready(function(){
        setTimeout(function(){
        $("div.alert").fadeOut();
        }, 5000 ); // 5 secs
    });
</script>

@stop
