@extends('layout.layout')

@section('title','IM CLIENT')

@section('content')

<div class="pull-left">
    <h2>BIENVENIDO</h2>
    </div>
  
    <div class="pull-right mb-2">
    <a class="btn btn-primary" href="{{ route('soycliente.create',$client) }}" >NUEVA INCIDENCIA</a>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    <div class="card-body">
        <h2 class="text-center">MIS CUOTAS:</h2>
        <table class="table table-striped">
    <thead>
        <tr>
            <th >#</th>
            <th >CONCEPTO</th>
            <th>IMPORTE</th>
            <th>PAGADA</th>
            <th>FECHA CREACION</th>
            <th>FECHA PAGO</th>
            <th>NOTAS</th>
           
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
                <td>{{ $cuote->fechaPago }}</td>
                <td>{{ $cuote->notas }}</td>  
                <td>
                    <td><a href="{{ url('/paypal/pay')}}" class="btn btn-danger btn-sm">PAGAR</a></td> 
            </tr>
        @endforeach
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