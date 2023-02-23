@extends('layout.layout')

@section('title','SHOW TASK')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>DETAILS OF TASK {{$task->id}}</h1>

        <table class="table table-striped">
            <thead>
            <tr>
            <th>Id</th>
            <th>Name</th>
            <th>TLF</th>
            <th>EMAIL</th>
            <th>DESCRIPCION</th>
            <th>DIRECCION</th>
            <th>POBLACION</th>
            <th>CP</th>
            <th>PROVINCIA</th>
            </tr>
            </thead>
            <tbody>
                    <tr>
                        <th scope="row">{{ $task->id }}</th>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->tlf }}</td>
                        <td>{{ $task->email }}</td>
                        <td>{{ $task->descripcion }}</td>
                        <td>{{ $task->direccion }}</td>
                        <td>{{ $task->poblacion }}</td>
                        <td>{{ $task->cp }}</td>
                        <td>{{ $task->provincia }}</td>
                    </tr>
                    <br>
       <tr>  
            <th>CLIENTE</th>
            <th>OPERARIO</th>
            <th>ANOT. ANTERIORES</th>
            <th>ANOT. POSTERIORES </th>
            <th>FICHERO</th>
            <th>FECHA CREACION</th>
            <th>FECHA REALIZACION</th>
            <th>ESTADO</th>
            </tr>
            <tr>
            <td>{{ $task->clients_id }}</td>
            <td>{{ $task->users_id }}</td>
            <td>{{ $task->anotA }}</td>
            <td>{{ $task->anotP }}</td>
            <td>
                @if($task->fichero != '' && $task->fichero != NULL)
                    <a href="{{ $url }}" download="">{{$task->fichero}}</a>
                @endif
            </td>
                
            <td>{{ $task->fechaC }}</td>
            <td>{{ $task->fechaR }}</td>
            <td>{{ $task->estadoTarea }}</td>     
        </tr>
            </tbody>
            </table>

    </div>
    <div class="mt-4">
        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('tasks.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
