@extends('layout.layout')

@section('title','USERS')

@section('content')
    
<div class="pull-left">
    <h2>MY DATA:</h2>
    </div>
    <div class="pull-right mb-2">    
      @foreach($users as $user)
    {{-- <a class="btn btn-success" href="{{ route('misdatos.edit') }}">EDIT MY DATA</a> --}}
    <a href="{{ route('misdatos.edit', $user->id) }}" class="btn btn-info btn-sm">EDIT MY DATA</a>
    <div class="container mt-4">
    
        <div>
            <strong>id:</strong>  {{ $user->id }}
         </div> 
        <div>
            <strong>name:</strong>  {{ $user->name }}
         </div> 
         <div>
            <strong>username:</strong>  {{ $user->username }}
         </div> 
         <div>
             <strong>nif:</strong>  {{ $user->nif }}
          </div>
         <div>
             <strong>email:</strong> {{ $user->email }}
         </div>
         <div>
             <strong>tlf:</strong>  {{ $user->tlf }}
          </div>
          <div>
             <strong>direccion:</strong>  {{ $user->direccion }}
          </div>
          {{-- <div>
             <strong>password:</strong>  {{ $user->password }}
          </div> --}}
          <div>
             <strong>fecha alta:</strong>  {{ $user->created_at }}
          </div>
          <div>
             <strong>tipo:</strong>  {{ $user->tipo }}
          </div>
    </div>
    @endforeach

    </div>
    @endsection
