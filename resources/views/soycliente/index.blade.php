@extends('layout.layout')

@section('title','IM CLIENT')

@section('content')

<div class="pull-left">
    <h2>hola soy un cliente :3:</h2>
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
        
    </tbody>
    </table>
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