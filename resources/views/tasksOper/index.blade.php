@extends('layout.layout')

@section('title','TASKS')

@section('content')

<div class="pull-left">
     <h2>MY TASKS</h2>  
    </div>
    <div class="pull-right mb-2">
        <a href="{{ route('tasksOper.pendientes') }}" class="btn btn-info btn-sm">VER PENDIENTES</a>    
       
    </div>

  
    <div class="card-body">
        <table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Anot.</th>
            <th>Anot. post </th>
            <th>FECHA CREACION</th>
            <th>FECHA REALIZACION</th>
    
        </tr>
    </thead>
    <tbody>
        @foreach($tasksOper as $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->descripcion }}</td>
                <td>{{ $task->estadoTarea }}</td>
                <td>{{ $task->anotA }}</td>
                <td>{{ $task->anotP }}</td>
                <td>{{ $task->fechaC }}</td>
                <td>{{ $task->fechaR }}</td>
                <td>
                    <td><a href="{{ route('tasksOper.show', $task->id) }}" class="btn btn-warning btn-sm">Show</a></td>
            </tr>
        @endforeach
    </tbody>
    </table>
    </div>

    <div class="d-flex">
        {{-- {!! $tasksOper->links() !!} --}}
    </div>
    </div>

@endsection
