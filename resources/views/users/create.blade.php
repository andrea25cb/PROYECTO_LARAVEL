@extends('layout.layout')

@section('title','NEW USER')

@section('content')

<div class="pull-right">
    <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
    </div><br>
    <div class="bg-light p-4 rounded">
        <h1>Add new user</h1>

        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
        {{ session('status') }}
        </div>
        @endif
        
        <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <br>
        
        <div class="input-group">
            <span class="input-group-text">nif  </span>
                <input  value="{{ old('nif') }}"   class="form-control" type="text" name="nif" >
        </div>
            @error('nif')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror<p>


            <div class="input-group">
                <span class="input-group-text">name  </span>
                    <input  value="{{ old('name') }}"   class="form-control" type="text" name="name" >
            </div>
            @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror<p>

                <div class="input-group">
                    <span class="input-group-text">username  </span>
                        <input value="{{ old('username') }}" class="form-control" type="text" name="username" >
                </div>
    
                @error('username')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror<p>
    
                <div class="input-group">
                <span class="input-group-text">direccion  </span>
                    <input  value="{{ old('direccion') }}"   class="form-control" type="text" name="direccion" >              
            </div>  
            @error('direccion')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror<p>

                <div class="input-group">
                <span class="input-group-text">email  </span>
                    <input value="{{ old('email') }}"  class="form-control" type="text" name="email" >
          
            </div>  
            @error('email')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror<p>

            <div class="input-group">
                <span class="input-group-text">tlf  </span>
                    <input  value="{{ old('tlf') }}"   class="form-control" type="text" name="tlf" >
            </div> 
            @error('tlf')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror<p>
      
            <div class="input-group">
                <span class="input-group-text">password  </span>
                    <input  value="{{ old('password') }}"   class="form-control" type="text" name="password" >
          
                  
            </div>  @error('password')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror<p>
            <br>

          
            Tipo:
            <select name="tipo" id="tipo" class="form-control">
                <option value="admin" @selected(old('tipo')) >admin </option>
                <option value="operario" @selected(old('tipo'))  >operario </option>
              </select>
<br>
                <button type="submit" class="btn btn-primary">Save user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
