@extends('layout.layout')

@section('title','TASKS')

@section('content')

<div class="pull-left">
    <h2>TASKS TO DO:</h2>
    </div>
    <div class="pull-right mb-2">

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
                    <td><a href="{{ route('tasksOper.show', $task->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                    <td><a href="{{ route('tasksOper.edit', $task->id) }}" class="btn btn-info btn-sm">Complete</a></td>
                        
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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