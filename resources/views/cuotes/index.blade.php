@extends('layout.layout')

@section('title','cuotes')

@section('content')
   
<div class="pull-left">
    <h2>CUOTES LIST:</h2>
    </div>
    <div class="pull-right mb-2">
    <a class="btn btn-success" href="{{ route('cuotes.create') }}"> NEW cuote</a>
    
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
                <th >ACCOUNT</th>
                <th scope="col" width="10%">PAIS</th>
                <th scope="col" width="10%">MONEDA</th>
                <th scope="col" width="10%">CUOTA MENSUAL</th>
                <th scope="col" width="1%" colspan="3"></th>    
            </tr>
            </thead>
            <tbody>
                @foreach($cuotes as $cuote)
                    <tr>
                        <th scope="row">{{ $cuote->id }}</th>
                        <td>{{ $cuote->nif }}</td>
                        <td>{{ $cuote->name }}</td>
                        <td>{{ $cuote->tlf }}</td>
                        <td>{{ $cuote->email }}</td>
                        <td>{{ $cuote->cuentaCorriente }}</td>
                        <td>{{ $cuote->pais }}</td>
                        <td>{{ $cuote->moneda }}</td>
                        <td>{{ $cuote->importeCuotaMes }}</td>
                        <td><a href="{{ route('cuotes.show', $cuote->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                        <td><a href="{{ route('cuotes.edit', $cuote->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                        <td> 
                            <form class="form-eliminar" method="POST" action="{{ route('cuotes.destroy', $cuote->id) }}"> 
                               @method('DELETE')
                               @csrf
                               <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt" aria-hidden="true"></i> Delete</button>
                           </form>
                       </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex">
            {!! $cuotes->links() !!}
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
            'Your cuote has been deleted.',
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
            'Your cuote is safe :)',
            'error'
    )
  }
})
    });
</script>

@endsection