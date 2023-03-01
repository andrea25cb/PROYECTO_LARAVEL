@extends('layout.layout')

@section('title','IM CLIENT')

    @section('content')
    <div class="container">
        @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('client creates task') }}</div>
                    <div class="card-body">
                       
                    <form action="{{ route('soycliente.create') }}" method="POST">
                        @csrf
                    
                        <div class="input-group">
                            <span class="input-group-text">NIF  </span>
                                    <input id="nif" type="text" class="form-control @error('nif')  @enderror" name="nif" value="{{ old('nif') }}" autocomplete="nif"  placeholder="NIF">
                                </div>
                                    @error('nif')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror<p>
                         
    
                            <div class="input-group">
                                <span class="input-group-text">TLF  </span>
                                    <input id="tlf" type="text" class="form-control @error('tlf')  @enderror" name="tlf" value="{{ old('tlf') }}" autocomplete="tlf"  placeholder="000-000-000">
                                </div>
                                    @error('tlf')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror<p><br>
                            

                            <div class="input-group">
                                <span class="input-group-text">Persona de contacto  </span>
                                    <input value="{{ old('name') }}"  class="form-control" type="text" name="name" placeholder="Marcos Gonzalez Rodriguez">
                            </div>
                            @error('name')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror<p>
                                  
                                 <!-- Descripción de la tarea -->
                            <p>Descripción tarea:<br>
                            <textarea class="form-control" name="descripcion" value="{{ old('descripcion') }}">{{ old('descripcion') }}</textarea>
                            
                            @error('descripcion')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            <!-- Correo Electrónico -->
                            <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Email</span>
                            <input name="email" class="form-control"class="form-control" placeholder="usuario@mail.com" value="{{ old('email') }}"><br>
                            
                            </div> 
                            @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                                 <!-- Dirección -->
                            <p>Dirección:<br>
                            <textarea class="form-control" name="direccion" value="{{ old('direccion') }}">{{ old('direccion') }}</textarea>
                            
                            <!-- Población -->
                            <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Población</span>
                            <input type="text" class="form-control" class="form-control"  name="poblacion" value="{{ old('poblacion') }}">
                            </div>
                            
                            Provincia:
                            <select name="provincia" class="form-control">
                              @foreach ($provincias as $provincia)
                              <option value="{{$provincia['nombre']}}" @selected(old('provincia') == $provincia['nombre'])> {{$provincia["nombre"]}} </option>
                              @endforeach
                            </select>
                            
                            <br>
                            <!-- Código Postal -->
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">CP</span>
                                <input type="text" class="form-control"class="form-control" name="cp" value="{{ old('cp') }}">
                              </div> @error('cp')
                              <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                              @enderror<p> 
                            
                            <p class="form-check">
                            <p>ESTADO TAREA: 
                              {{-- tres radio buttons --}}
                              <input type="radio" name="estadoTarea" id="Esperando a ser aprobada" value="Esperando a ser aprobada"> Esperando a ser aprobada</label>
                              <input type="radio" name="estadoTarea" id="Realizada" value="Realizada" checked> Realizada</label>
                              <input type="radio" name="estadoTarea" id="Cancelada" value="Cancelada"> Cancelada</label>
                            </p>
                            
                            <p>Fecha creación:
                              <input type="datetime-local" name="fechaC" readonly value="<?=date('Y-m-d H:i:s')?>">
                            <br>
                            
                            <p>Anotaciones anteriores:<br>
                            <textarea class="form-control" name="anotA" value="{{ old('anotA') }}"> texto que se desee incluir para explicar el trabajo a realizar antes de comenzarlo.</textarea>
                            
                            <p>Cliente: yo
                              {{-- <input type="hidden" name="clients_id" value="{{$client}}"> --}}
                            
                            <p>Fecha realización:
                            <input type="datetime-local" name="fechaR" value="{{ old('fechaR') }}"> </p> 
                                @error('fechaR')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            
                            <p>Anotaciones posteriores:<br>
                            <textarea class="form-control" name="anotP" value="{{ old('anotP') }}"> Anotaciones realizadas por los operarios después de realizar la tarea.</textarea></p>
    
                            <button class="w-100 btn btn-lg btn-success" type="submit">CREATE TASK AS CLIENT</button>
    
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