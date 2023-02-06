@extends('layout.layout')

@section('title','SHOW cuote')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show cuote {{$cuote->id}}</h1>
        <div class="lead">
            
        </div>

        <div class="container mt-4">
            <div>
               <strong>Concepto:</strong>  {{ $cuote->concepto }}
            </div> 
            <div>
                <strong>Fecha Creacion:</strong>  {{ $cuote->created_at }}
             </div>
            <div>
                <strong>Importe:</strong> {{ $cuote->importe }}
            </div>
            <div>
                <strong>Pagada:</strong>  {{ $cuote->pagada }}
             </div>
             <div>
                <strong>fechaPago:</strong>  {{ $cuote->fechaPago }}
             </div>
             <div>
                <strong>notas:</strong>  {{ $cuote->notas }}
             </div>
             <div>
                <strong>cliente:</strong>  {{ $cuote->clients_id }}
             </div>

            
        </div>      

    </div>
    <div class="mt-4">
        <a href="{{ route('cuotes.edit', $cuote->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('cuotes.index') }}" class="btn btn-default">Back</a> 
    </div>
@endsection
