@extends('layout.layout')

@section('title','LOGIN')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
    <form method="post" action="{{ route('login.perform') }}">

        <div class="form-group form-floating mb-3">
            <input id="username" placeholder="Username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}"  autocomplete="username">
            <label for="floatingName">Email Address or Username</label>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        
        <div class="form-group form-floating mb-3">
            <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">
            <label for="password">Password
            </label><a href="{{route('password.request')}}" class="float-right"> Forgot Password?</a>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="remember">Remember me</label>
            <input type="checkbox" name="remember" value="1">
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button><br><br>
        <a class="btn btn-warning text-danger" href="{{ route('login-google') }}">Login with Google</a> 
        <a class="btn btn-dark text-white" href="{{ url('auth/github') }}">Login with GitHub</a>
    </form>
</div>
</div>
</div>
</div>
</div>
@endsection

