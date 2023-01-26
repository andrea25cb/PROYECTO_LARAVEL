@extends('layout.layout')

@section('title','SHOW CLIENT')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show client {{$client->id}}</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
               <strong>name:</strong>  {{ $client->name }}
            </div> 
            <div>
                <strong>nif:</strong>  {{ $client->nif }}
             </div>
            <div>
                <strong>email:</strong> {{ $client->email }}
            </div>
            <div>
                <strong>tlf:</strong>  {{ $client->tlf }}
             </div>
             <div>
                <strong>cuenta Corriente:</strong>  {{ $client->cuentaCorriente }}
             </div>
             <div>
                <strong>pais:</strong>  {{ $client->pais }}
             </div>
             <div>
                <strong>moneda:</strong>  {{ $client->moneda }}
             </div>
             <div>
                <strong>mensual cuote:</strong>  {{ $client->cuotaMensual }}
             </div>
            
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('clients.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
