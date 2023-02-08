@extends('layout.layout')

@section('title','CUOTES')

@section('content')
   
<div class="pull-left">
    <h2>CUOTES LIST:</h2>
    </div>
    <div class="pull-right mb-2">
    <a class="btn btn-success" href="{{ route('cuotes.create') }}"> NEW INDIVIDUAL CUOTE</a>
    <a class="btn btn-info" href=""> NEW GROUPAL CUOTE</a>
    
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card-body">
        <table class="table table-striped">
    <thead>
    <tr>
                <th >#</th>
                <th >CONCEPTO</th>
                <th>IMPORTE</th>
                <th>PAGADA</th>
                <th>FECHA CREACION</th>
                {{-- <th>FECHA PAGO</th>
                <th>NOTAS</th> --}}
                <th>CLIENTE</th>
                <th width="1%" colspan="3"></th>    
            </tr>
            </thead>
            <tbody>
                @foreach($cuotes as $cuote)
                    <tr>
                        <th scope="row">{{ $cuote->id }}</th>
                        <td>{{ $cuote->concepto }}</td>
                        <td>{{ $cuote->importe }}</td>
                        <td>{{ $cuote->pagada }}</td>
                        <td>{{ $cuote->created_at }}</td>
                        {{-- <td>{{ $cuote->fechaPago }}</td>
                        <td>{{ $cuote->notas }}</td>   --}}
                        <td>{{ $cuote->clients_id }}</td>
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