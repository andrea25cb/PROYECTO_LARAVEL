@extends('layout.layout')

@section('title','NEW GROUPAL CUOTE')

@section('content')
<div class="pull-right">
    {{-- <a class="btn btn-primary" href="{{ route('cuotes.index') }}"> Back</a> --}}
    </div><br>
    <div class="bg-light p-4 rounded">
        <h1>ADDING NEW GROUPAL CUOTE:</h1>

        <div class="container mt-4">
            <form action="{{ route('cuotes.storeall') }}" method="POST">

                <div class="input-group">
                    <span class="input-group-text">concepto  </span>
                        <input  value="{{ old('concepto') }}"   class="form-control" type="text" name="concepto" >
                        
                </div>@error('concepto')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror<p><br>
                    <div class="input-group">
                        <p>Fecha creación:
                            <input type="date" name="created_at" readonly value="<?=date('Y-m-d')?>">
                          <br>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">importe  </span>
                            <input value="{{ old('importe') }}" class="form-control" type="text" name="importe" >
                          
                    </div>  @error('importe')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">PAGADA:  </span>
                        <input type="radio" name="pagada" value="S"> Si</label>
                        <input type="radio" name="pagada" value="N"> No</label>
                           
                    </div>
                    <br>

                    <p>Fecha pago:
                        <input type="date" name="fechaPago" value="{{ old('fechaPago') }}"> </p> 
                        
<br>    @error('fechaPago')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
<p>Anotaciones:<br>
    <textarea class="form-control" name="notas" value="{{ old('notas') }}"> Anotaciones sobre la cuota</textarea></p>
    <br>
    <p>Cliente: todos
      <br>
                <button type="submit" class="btn btn-primary">Guardar cuota</button>
                <a href="{{ route('cuotes.index') }}" class="btn btn-default">Volver</a>
            </form>
        </div>

    </div>
@endsection
