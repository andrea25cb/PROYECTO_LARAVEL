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
            <form action="{{ route('clients.update',$cuote->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="input-group">
                    <span class="input-group-text">nif  </span>
                        <input value="{{ $cuote->nif }}"  class="form-control" type="text" name="nif" >
              
                        @error('nif')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror<p>
                </div><br>
                    <div class="input-group">
                        <span class="input-group-text">name  </span>
                            <input value="{{ $cuote->name }}"  class="form-control" type="text" name="name" >
                  
                            @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div><br>
                 
                    <div class="input-group">
                        <span class="input-group-text">email  </span>
                            <input value="{{ $cuote->email }}"  class="form-control" type="text" name="email" >
                  
                            @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">tlf  </span>
                            <input value="{{ $cuote->tlf }}"  class="form-control" type="text" name="tlf" >
                            @error('tlf')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div><br>

                    <div class="input-group">
                        <span class="input-group-text">Cuenta corriente:  </span>
                            <input value="{{ $cuote->cuentaCorriente }}" class="form-control" type="text" name="cuentaCorriente" >
                            @error('cuentaCorriente')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
<br>
                {{-- Pais:
                <select name="pais" id="pais" class="form-control">
                @foreach ($paises as $pais)
                    <option value="{{ $cuote->pais }}"  >{{ $cuote->pais }} </option>
                @endforeach
                </select>
<br>
                Moneda:
                <select name="moneda" id="moneda" class="form-control">
                @foreach ($paises as $pais)
                    <option value="{{ $cuote->moneda }}"  >{{ $cuote->moneda }} </option>
                @endforeach
                </select><br> --}}

                <button type="submit" class="btn btn-primary">Update cuote</button>
                <a href="{{ route('clients.index') }}" class="btn btn-default">Cancel</button>
            </form>
        </div>

    </div>
@endsection
