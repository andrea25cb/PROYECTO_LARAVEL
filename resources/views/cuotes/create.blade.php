@extends('layout.layout')

@section('title','NEW CUOTE')

@section('content')
<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('cuotes.index') }}"> Back</a>
    </div><br>
    <div class="bg-light p-4 rounded">
        <h1>ADDING NEW CUOTE:</h1>

        <div class="container mt-4">
            <form action="{{ route('cuotes.store') }}" method="POST">

                <div class="input-group">
                    <span class="input-group-text">concepto  </span>
                        <input  value="{{ old('concepto') }}"   class="form-control" type="text" name="concepto" >
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
                            <input value="{{ old('importe') }}" class="form-control" type="text" name="importe" >
                            @error('importe')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">PAGADA:  </span>
                        <input type="radio" name="pagada" value="S"> Si</label>
                        <input type="radio" name="pagada" value="N"> No</label>
                           
                        {{-- <input  value="{{ old('tlf') }}" class="form-control" type="text" name="tlf" >
                            @error('tlf')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p> --}}
                    </div>
                    <br>

                    <p>Fecha pago:
                        <input type="date" name="fechaPago" value="{{ old('fechaPago') }}"> </p> 
                            @error('fechaPago')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
<br>
<p>Anotaciones:<br>
    <textarea class="form-control" name="notas" value="{{ old('notas') }}"> Anotaciones sobre la cuota</textarea></p>
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
@endsection
