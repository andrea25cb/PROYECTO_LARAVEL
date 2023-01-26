@extends('layout.layout')

@section('title','USERS')

@section('content')
    
<div class="pull-left">
    <h2>USERS LIST:</h2>
    </div>
    <div class="pull-right mb-2">
    <a class="btn btn-success" href="{{ route('users.create') }}"> NEW USER</a>
    
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
                <th scope="col" width="15%">NAME</th>
                <th scope="col" width="10%">ADDRESS</th>
                <th scope="col" width="10%">EMAIL</th>
                <th scope="col" width="10%">TLF</th>
                <th scope="col" width="10%">TIPO</th>
                <th scope="col" width="1%" colspan="3"></th>    
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->nif }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->direccion }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->tlf }}</td>
            
                        <td>{{ $user->tipo }}</td>
                        <td>
                            <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                                <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                                <td> 
                                    <form class="form-eliminar" method="POST" action="{{ route('users.destroy', $user->id) }}"> 
                                       @method('DELETE')
                                       @csrf
                                       <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt" aria-hidden="true"></i> Delete</button>
                                   </form>
                               </td>
                        </td>
                    </tr>
                    
                    </tr>
                @endforeach
            </tbody>
    </table>
    </div>

    <div class="d-flex">
        {!! $users->links() !!}
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
            'User has been deleted.',
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
            'User is safe :)',
            'error'
    )
  }
})
    });
</script>

@endsection