@extends('layout.layout')

@section('title','NEW CLIENT')

@section('content')
<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('cuotes.index') }}"> Back</a>
    </div><br>
    <div class="bg-light p-4 rounded">
        <h1>Añadir nuevo client</h1>

        <div class="container mt-4">
            <form method="POST" action="">
                @csrf
                <div class="input-group">
                    <span class="input-group-text">nif  </span>
                        <input  value="{{ old('nif') }}"   class="form-control" type="text" name="nif" >
                        @error('nif')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror<p>
                </div><br>
                    <div class="input-group">
                        <span class="input-group-text">name  </span>
                            <input  value="{{ old('name') }}"   class="form-control" type="text" name="name" >
                  
                            @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">email  </span>
                            <input value="{{ old('email') }}" class="form-control" type="text" name="email" >
                            @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">tlf  </span>
                            <input  value="{{ old('tlf') }}" class="form-control" type="text" name="tlf" >
                            @error('tlf')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
                    <br>

                    <div class="input-group">
                        <span class="input-group-text">Cuenta corriente:  </span>
                            <input  value="{{ old('cuentaCorriente') }}" class="form-control" type="text" name="cuentaCorriente" >
                            @error('cuentaCorriente')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
<br>
                Pais:
                <select name="pais" id="pais" class="form-control">
                @foreach ($paises as $pais)
                    <option value="{{ $pais->nombre }}"  >{{ $pais->nombre }} </option>
                @endforeach
                </select>
<br>
                Moneda:
                <select name="moneda" id="moneda" class="form-control">
                @foreach ($paises as $pais)
                    <option value="{{ $pais->iso_moneda }}"  >{{ $pais->iso_moneda }} </option>
                @endforeach
                </select><br>
                <button type="submit" class="btn btn-primary">Guardar cliente</button>
                <a href="{{ route('cuotes.index') }}" class="btn btn-default">Volver</a>
            </form>
        </div>

    </div>
@endsection
