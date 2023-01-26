@extends('layout.layout')

@section('title','SHOW USER')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show user {{$user->id}}</h1>
        <div class="lead">
            
        </div>
        
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
              <div>
                 <strong>password:</strong>  {{ $user->password }}
              </div>
              <div>
                 <strong>fecha alta:</strong>  {{ $user->created_at }}
              </div>
              <div>
                 <strong>tipo:</strong>  {{ $user->tipo }}
              </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
