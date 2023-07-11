@extends('admin.auth.app')
@section('content')

                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Verify!</h1>
                                </div>
                                <form class="user">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                               id="otp_code" aria-describedby="Verify"
                                               placeholder="Enter Verification Code..."
                                               value="tazesalgy@gmail.com" disabled>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                               id="otp_code" aria-describedby="Verify"
                                               placeholder="Enter Verification Code...">
                                    </div>
                                    <a href="index.html" class="btn btn-primary btn-user btn-block">
                                        Verify
                                    </a>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('admin.dashboard') }}">Home</a>
                                    <span class="text-dark">/</span>
                                    <a class="small" href="{{ route('admin.dashboard') }}">Resend!</a>
                                </div>
                            </div>
                        </div>
@endsection
