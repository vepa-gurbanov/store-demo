@extends('admin.auth.app')
@section('content')

    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
    <div class="col-lg-6">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">We will verify you as soon as and email you!</h1>
            </div>
            <hr>
            <div class="text-center">
                <a class="small" href="{{ route('home') }}">
                    <?php session()->forget('auth') ?>
                    Home
                </a>
            </div>
        </div>
    </div>
@endsection
