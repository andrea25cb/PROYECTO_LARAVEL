@extends('layout.layout')

@section('title','CLIENTS')

@section('content')
   
<div class="pull-left">
    <h2>CLIENTS LIST:</h2>
    </div>
    <div class="pull-right mb-2">
    <a class="btn btn-success" href="{{ route('clients.create') }}"> NEW CLIENT</a>
    
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card-body">
        <table class="table table-striped">
    <thead>
    <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">NIF</th>
                <th scope="col">NAME</th>
                <th scope="col" width="10%">TLF</th>
                <th scope="col" width="10%">EMAIL</th>
                <th scope="col" width="10%">PAIS</th>
                <th scope="col" width="10%">MONEDA</th>
                <th scope="col" width="10%">CUOTA MENSUAL</th>
                <th scope="col" width="1%" colspan="3"></th>    
            </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                    <tr>
                        <th scope="row">{{ $client->id }}</th>
                        <td>{{ $client->nif }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->tlf }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->pais }}</td>
                        <td>{{ $client->moneda }}</td>
                        <td>{{ $client->cuotaMensual }}</td>
                        <td><a href="{{ route('clients.show', $client->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                        <td><a href="{{ route('clients.edit', $client->id) }}" class="btn btn-info btn-sm"><img width="20px" src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png"></a></td>
                        <td> 
                            <form class="form-eliminar" method="POST" action="{{ route('clients.destroy', $client->id) }}"> 
                               @method('DELETE')
                               @csrf
                               <button type="submit" class="btn btn-danger btn-sm"><img width="20px" src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png"> </button>
                           </form>
                       </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex">
            {!! $clients->links() !!}
        </div>

    </div>
@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.8/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">


@if(session('delete') == 'ok')
    <script>
        swalWithBootstrapButtons.fire(
            'Deleted!',
            'Client has been deleted.',
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
            'Your client is safe :)',
            'error'
    )
  }
})
    });
</script>

@endsection