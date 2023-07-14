@extends('admin.auth.app')
@section('content')

    <div class="col-lg-6 d-none d-lg-block bg-register-image"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
            </div>
            <form action="{{ route('admin.auth.register') }}" class="user" method="POST">
                @csrf
                @honeypot
                @method('POST')

                <div class="form-group">
                    <input type="text"
                           class="form-control form-control-user"
                           name="name"
                           id="name"
                           aria-describedby="name"
                           placeholder="Enter Name..." autofocus>
                </div>
                <div class="form-group">
                    <input type="email"
                           class="form-control form-control-user"
                           name="email"
                           id="email"
                           aria-describedby="email"
                           placeholder="Enter Email Address..."
{{--                           value="{{ $data['email'] }}">--}}
                           value="{{ isset(session()->get('auth')['guest_admin']['email']) ? session()->get('auth')['guest_admin']['email'] : '' }}">
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Create
                </button>
            </form>
            <hr>
            <div class="text-center">
                <a class="small" href="{{ route('admin.dashboard') }}">Home</a>
                <span class="text-dark">/</span>
                <a class="small" href="{{ route('admin.dashboard') }}">Login</a>
            </div>
        </div>
    </div>

@endsection
