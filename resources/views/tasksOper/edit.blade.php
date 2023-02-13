@extends('layout.layout')

@section('title','EDIT MY TASK')

@section('content')

<div class="container mt-2">
  <div class="row">
  <div class="col-lg-12 margin-tb">
  <div class="pull-left">
  <h2>COMPLETING TASK {{ $task->id }}</h2>
  </div>
  <div class="pull-right">
  <a class="btn btn-primary" href="{{ route('tasksOper.pendientes') }}" enctype="multipart/form-data"> Back</a>
  </div>
  </div>
  </div>
      @if(session('status'))
      <div class="alert alert-success mb-1 mt-1">
      {{ session('status') }}
      </div>
      @endif
  <form action="{{ route('tasksOper.update',$task->id) }}" method="POST" enctype="multipart/form-data">
  {{-- @csrf --}}
  @method('put')

  <p class="form-check">
  <p>ESTADO TAREA: 
    {{-- tres radio buttons --}}
    <input type="radio" name="estadoTarea" id="Esperando a ser aprobada" value="Esperando a ser aprobada"> Esperando a ser aprobada</label>
    <input type="radio" name="estadoTarea" id="Realizada" value="Realizada" checked> Realizada</label>
    <input type="radio" name="estadoTarea" id="Cancelada" value="Cancelada"> Cancelada</label>

  </p>

  <p>Fecha creación:
    <input type="datetime-local" name="fechaC" readonly value="{{ $task->fechaC }}">
    <br>
    <p>Anotaciones anteriores:<br>
    <textarea class="form-control" name="anotA" value="{{ $task->anotA }}"> {{ $task->anotA }}
    </textarea>

    <p>Fecha realización:
      <input type="datetime-local" name="fechaR" value="{{ $task->fechaR  }}"> </p> 
          @error('fechaR')
          <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
          @enderror

    <p>Anotaciones posteriores:<br>
    <textarea class="form-control" name="anotP" value="{{ $task->anotP }}">{{ $task->anotP }}</textarea></p>
    <!-- permitir adjuntar fichero -->
    <div class="input-group mb-3">
        <label class="input-group-text" for="inputGroupFile01">ADJUNTAR FICHERO</label>
        <input type="file" class="form-control" id="inputGroupFile01" name="fichero" value="{{ $task->fichero }}">
    </div>

  <div class="col-md-6 col-md-offset-4">
    <button type="submit" class="btn btn-primary">
      ENVIAR
    </button>
  </form>
</div>
@endsection