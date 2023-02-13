@extends('layout.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('soycliente.perform') }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="row mb-3">
                            <label for="nif" class="col-md-4 col-form-label text-md-end">{{ __('NIF') }}</label>

                            <div class="col-md-6">
                                <input id="nif" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ old('nif') }}" autocomplete="nif"  placeholder="NIF">

                                @error('nif')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="tlf" class="col-md-4 col-form-label text-md-end">{{ __('TLF') }}</label>

                            <div class="col-md-6">
                                <input id="tlf" type="text" class="form-control @error('tlf') is-invalid @enderror" name="tlf" value="{{ old('tlf') }}" autocomplete="tlf"  placeholder="000-000-000">

                                @error('tlf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
