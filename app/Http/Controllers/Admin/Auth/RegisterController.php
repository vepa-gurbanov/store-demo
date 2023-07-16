<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verification;
use App\Services\Contracts\Admin as AdminContract;
use Illuminate\Http\Request;
use \App\Services\Traits\Admin as AdminTrait;

class RegisterController extends Controller
{
    public function create() {
        return view('admin.auth.register');
    }


    public function store(Request $request) {
        $validation = $request->validate([
            'name' => ['required', 'string', 'min:2'],
            'email' => ['required', 'string', 'email'],
        ]);

        $otp = rand(10000, 99999);
        $verification = Verification::create([
            'username' => $validation['email'],
            'code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        session()->put('auth', [
            'guest_admin' => [
                'name' => $validation['name'],
                'email' => $validation['email'],
                'verification_id' => $verification->id
            ],
        ]);

        $data = [
            'success' => 'Verification sent!'
        ];
        return to_route('admin.auth.verify')
            ->with($data);
    }


    public function wait() {
        return view('admin.auth.wait');
    }
}
