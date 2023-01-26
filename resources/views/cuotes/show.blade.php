@extends('layout.layout')

@section('title','SHOW cuote')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show cuote {{$cuote->id}}</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
               <strong>name:</strong>  {{ $cuote->name }}
            </div> 
            <div>
                <strong>nif:</strong>  {{ $cuote->nif }}
             </div>
            <div>
                <strong>email:</strong> {{ $cuote->email }}
            </div>
            <div>
                <strong>tlf:</strong>  {{ $cuote->tlf }}
             </div>
             <div>
                <strong>cuenta Corriente:</strong>  {{ $cuote->cuentaCorriente }}
             </div>
             <div>
                <strong>pais:</strong>  {{ $cuote->pais }}
             </div>
             <div>
                <strong>moneda:</strong>  {{ $cuote->moneda }}
             </div>
             <div>
                <strong>mensual cuote:</strong>  {{ $cuote->cuotaMensual }}
             </div>
            
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('clients.edit', $cuote->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('clients.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
