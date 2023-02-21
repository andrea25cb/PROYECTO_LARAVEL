@extends('layout.layout')

@section('title','IM CLIENT')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('login cliente') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('soycliente.login') }}">
                            {{-- @method('put') --}}
                            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> --}}
    
                            <div class="row mb-3">
                                <label for="nif" class="col-md-4 col-form-label text-md-end">{{ __('NIF') }}</label>
    
                                <div class="col-md-6">
                                    <input id="nif" type="text" class="form-control @error('nif')  @enderror" name="nif" value="{{ old('nif') }}" autocomplete="nif"  placeholder="NIF">
    
                                    @error('nif')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror<p><br>
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="tlf" class="col-md-4 col-form-label text-md-end">{{ __('TLF') }}</label>
    
                                <div class="col-md-6">
                                    <input id="tlf" type="text" class="form-control @error('tlf')  @enderror" name="tlf" value="{{ old('tlf') }}" autocomplete="tlf"  placeholder="000-000-000">
    
                                    @error('tlf')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror<p>
                                </div>
                            </div>
    
                            <button class="w-100 btn btn-lg btn-primary" type="submit">LOGIN AS CLIENT</button>
    
                        </form>
                   </div>
                </div>
            </div>
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