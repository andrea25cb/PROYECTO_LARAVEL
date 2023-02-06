@extends('layout.layout')

@section('title','EDIT cuote')

@section('content')
<div class="container mt-2">
    <div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="pull-left">
        <h2>Editing cuote {{ $cuote->id }}</h2>
    </div>
    <div class="pull-right">
    <a class="btn btn-primary" href="{{ route('users.index') }}" enctype="multipart/form-data"> Back</a>
    </div>
    </div>
    </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
        </div>
        @endif
        <div class="container mt-4">
            <form action="{{ route('cuotes.update',$cuote->id) }}" method="POST">
                {{-- @csrf --}}
                @method('PUT')

                <div class="input-group">
                    <span class="input-group-text">concepto  </span>
                        <input  value="{{ $cuote->concepto }}" class="form-control" type="text" name="concepto" >
                        @error('concepto')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror<p>
                </div><br>
                    <div class="input-group">
                        <p>Fecha creación:
                            <input type="date" name="created_at" readonly value="<?=date('Y-m-d')?>">
                          <br>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">importe  </span>
                            <input value="{{ $cuote->importe }}" class="form-control" type="text" name="importe" >
                            @error('importe')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">PAGADA:  </span>
                        <input type="radio" name="pagada" value="{{ $cuote->pagada }}"> Si</label>
                        <input type="radio" name="pagada" value="{{ $cuote->pagada }}"> No</label>
                           
                    </div>
                    <br>

                    <p>Fecha pago:
                        <input type="date" name="fechaPago" value="{{ $cuote->fechaPago }}"> </p> 
                            @error('fechaPago')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
<br>
<p>Anotaciones:<br>
    <textarea class="form-control" name="notas" value="{{ $cuote->notas }}"> Anotaciones sobre la cuota</textarea></p>
    <br>
    <p>Cliente:
        <select name="clients_id" id="clients" class="form-control">
            @foreach ($clients as $client)
                <option value="{{ $client->id }}"  >{{ $client->name }} </option>
            @endforeach
            </select>
      <br>
                <button type="submit" class="btn btn-primary">Guardar cuota</button>
                <a href="{{ route('cuotes.index') }}" class="btn btn-default">Volver</a>
            </form>
        </div>

    </div>

    </div>
@endsection
