@extends('admin.auth.app')
@section('content')

    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
            </div>
            <form action="{{ route('admin.auth.check') }}" class="user" method="POST">
                @csrf
                @honeypot
                @method('POST')

                <div class="form-group">
                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror"
                           name="email"
                           id="email"
                           aria-describedby="email"
                           placeholder="Enter Email Address..."
                           value="{{ session()->has('attempted') ? session()->get('attempted') : old('email') }}" autofocus>

                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Attempt
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{ route('admin.dashboard') }}">Home</a>
                <span class="text-dark">/</span>
                <a class="small" href="{{ route('admin.auth.register') }}">Create an Account!</a>
            </div>
        </div>
    </div>

@endsection
