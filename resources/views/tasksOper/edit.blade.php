@extends('layout.layout')

@section('title','EDIT TASK')

@section('content')

<div class="container mt-2">
  <div class="row">
  <div class="col-lg-12 margin-tb">
  <div class="pull-left">
  <h2>Editing task {{ $task->id }}</h2>
  </div>
  <div class="pull-right">
  <a class="btn btn-primary" href="{{ route('tasks.index') }}" enctype="multipart/form-data"> Back</a>
  </div>
  </div>
  </div>
      @if(session('status'))
      <div class="alert alert-success mb-1 mt-1">
      {{ session('status') }}
      </div>
      @endif
  <form action="{{ route('tasks.update',$task->id) }}" method="POST" enctype="multipart/form-data">
  {{-- @csrf --}}

  <!--Nombre y Apellidos  -->
  <div class="input-group">
      <span class="input-group-text">Persona de contacto  </span>
          <input value="{{ $task->name }}"  class="form-control" type="text" name="name" placeholder="Marcos Gonzalez Rodriguez">
  </div>
      @error('name')
      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
      @enderror<p>
      
  <!-- TLF -->
  <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">TLF</span>
      <input type="text" class="form-control" type="text" name="tlf" placeholder="000 000 000" value="{{ $task->tlf }}">
  </div>
  
  @error('tlf')
  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
  @enderror<p>   
      <!-- Descripción de la tarea -->
  <p>Descripción tarea:<br>
  <textarea class="form-control" name="descripcion" value="{{ $task->descripcion }}">{{ $task->descripcion }}</textarea>
  
  @error('descripcion')
      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
  <!-- Correo Electrónico -->
  <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">Email</span>
  <input name="email" class="form-control"class="form-control" placeholder="usuario@mail.com" value="{{ $task->email }}"><br>

  </div> 
  
  @error('email')
  <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
  @enderror
      <!-- Dirección -->
  <p>Dirección:<br>
  <textarea class="form-control" name="direccion" value="{{ $task->direccion }}">{{ $task->direccion }}</textarea>

  <!-- Población -->
  <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">Población</span>
  <input type="text" class="form-control"class="form-control" type="text" name="poblacion" value="{{ $task->poblacion }}">
  </div>

  Provincia:
  <select name="provincia" class="form-control">
    @foreach ($provincias as $provincia)
    <option value="{{ $task->provincia }}" @selected(old('provincia') == $provincia['nombre'])> {{$provincia["nombre"]}} </option>
    @endforeach
  </select>

  <br>
  <!-- Código Postal -->
  <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">CP</span>
      <input type="text" class="form-control"class="form-control" type="text" name="cp" value="{{ $task->cp }}">
    </div> 
    
    @error('cp')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror<p> 

  <p class="form-check">
  <p>ESTADO TAREA: 
    {{-- tres radio buttons --}}
    <input type="radio" name="estadoTarea" id="Esperando a ser aprobada" value="Esperando a ser aprobada"> Esperando a ser aprobada</label>
    <input type="radio" name="estadoTarea" id="Realizada" value="Realizada" checked> Realizada</label>
    <input type="radio" name="estadoTarea" id="Cancelada" value="Cancelada"> Cancelada</label>

  </p>

  <p>Fecha creación:
  <input type="date" name="fechaC" readonly value="{{ $task->fechaC }}">
  <br>
  <p>Anotaciones anteriores:<br>
  <textarea class="form-control" name="anotA" value="{{ $task->anotA }}"> {{ $task->anotA }}
  </textarea>
  <p>Operario encargado:
    <select name="users_id" id="user" class="form-control">
      @foreach ($users as $user)
          <option value="{{ $user->id }}"  >{{ $user->name }} </option>
      @endforeach
      </select>
  
      <p>Cliente:
        <select name="clients_id" id="client" class="form-control">
          @foreach ($clients as $client)
              <option value="{{ $client->id }}"  >{{ $client->name }} </option>
          @endforeach
          </select>

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