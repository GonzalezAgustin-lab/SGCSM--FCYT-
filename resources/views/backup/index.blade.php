@extends('backup.layouts.layout')
@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container text-center">     
  <br><br><br>       
  <div class="row"> 
    <div class="col text-center">
      <form id="backupForm" action="{{ route('backup.export') }}" method="POST">
          @csrf
          <a href="#" class="button" onclick="event.preventDefault(); document.getElementById('backupForm').submit();">
              <img src="{{ asset('/img/downloadDB.png') }}" height="140">
          </a>
          <h3 style="color: #3b557a">Descargar back up de datos</h3>
      </form>
    </div>
  </div>
</div>

@stop