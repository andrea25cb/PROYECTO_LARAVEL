@extends('layout.layout')

@section('title','TASKS')

@section('content')

<div class="pull-left">
    <h2>TASKS LIST:</h2>
    </div>
    <div class="pull-right mb-2">
    <a class="btn btn-success" href="{{ route('tasks.create') }}"> NEW TASK</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
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
        @foreach($tasks as $task)
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
                    <td><a href="{{ route('tasks.show', $task->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                        <td><a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-info btn-sm"><img width="20px" src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png"></a></td>
                         <td> 
                             <form class="form-eliminar" method="POST" action="{{ route('tasks.destroy', $task->id) }}"> 
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm"><img width="20px" src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png"></button>
                            </form>
                        </td>
            </tr>
        @endforeach
    </tbody>
    </table>
    </div>

    <div class="d-flex">
        {!! $tasks->links() !!}
    </div>
    </div>

@endsection

@section('js')

<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js
"></script>
<script type="text/javascript">


@if(session('delete') == 'ok')
    <script>
        swalWithBootstrapButtons.fire(
            'Deleted!',
            'Your task has been deleted.',
            'success'
            )
    </script>
@endif

    $('.form-eliminar').submit(function(e) {

        e.preventDefault();

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
            'Cancelled',
            'Your task is safe :)',
            'error'
    )
  }
})
    });
</script>

@endsection