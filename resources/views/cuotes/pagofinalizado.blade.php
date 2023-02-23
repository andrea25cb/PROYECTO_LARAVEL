@extends('layout.layout')

@section('title','PAGO FINALIZADO')

@section('content')

<div class="container text-center"><br><br>
    <span class="fw-bold border border-2 border-dark bg-white p-3">{{$status}}</span>
    <br>
    <a href="{{ route('cuotes.index') }}" class="btn btn-primary form-control mt-5">Volver</a>
</div>

@endsection