@extends('layout.layout')

@section('title','EDIT USER')

@section('content')
<div class="container mt-2">
    <div class="row">
    <div class="col-lg-12 margin-tb">
    <div class="pull-left">
    <h2>Editing user {{ $user->id }}</h2>
    </div>
    <div class="pull-right">
    <a class="btn btn-primary" href="{{ route('users.index') }}" enctype="multipart/form-data"> Back</a>
    </div>
    </div>
    </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
        </div>
        @endif
        <div class="container mt-4">
            <form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
             @method('PUT')

                <div class="input-group">
                    <span class="input-group-text">nif  </span>
                        <input value="{{ $user->nif }}"  class="form-control" type="text" name="nif" >
              
                        @error('nif')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror<p>
                </div><br>
                    <div class="input-group">
                        <span class="input-group-text">name  </span>
                            <input value="{{ $user->name }}"  class="form-control" type="text" name="name" >
                  
                            @error('name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-text">username  </span>
                            <input value="{{ $user->username }}"  class="form-control" type="text" name="username" >
                  
                            @error('username')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div><br>
                    <div class="input-group">
                        <span class="input-group-text">direccion  </span>
                            <input value="{{ $user->direccion }}"  class="form-control" type="text" name="direccion" >
                  
                            @error('direccion')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">email  </span>
                            <input value="{{ $user->email }}"  class="form-control" type="text" name="email" >
                            @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">tlf  </span>
                            <input value="{{ $user->tlf }}"  class="form-control" type="text" name="tlf" >
                            @error('tlf')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-text">password  </span>
                            <input value="{{ $user->password }}"  class="form-control" type="text" name="password" >
                  
                            @error('password')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror<p>
                    </div>
                    <br>
                    <select name="tipo" id="tipo" class="form-control">
                        {{ old('tipo') }}
          
                        <option value="admin">admin </option>
                        <option value="operario">operario </option>
                    </select><br>

                <button type="submit" class="btn btn-primary">Update user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
            </form>
        </div>

    </div>
@endsection
