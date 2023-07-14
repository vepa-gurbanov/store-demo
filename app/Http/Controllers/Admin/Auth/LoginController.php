<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use App\Services\Contracts\Admin as AdminContract;
use \App\Services\Traits\Admin as AdminTrait;

class LoginController extends Controller implements AdminContract
{
    use AdminTrait;

//    public function create() {
//            session()->has('auth') ?? session()->forget('auth');
//
//        return view('admin.auth.login');
//    }


//    public function store(Request $request) {
//        $validation = $request->validate([
//            'email' => ['required', 'string', 'email']
//        ]);
//
//        $user = User::where('email', $validation['email'])->first();
//        if ($user->exists()) {
//
//            $otp = rand(10000, 99999);
//            $verification = Verification::create([
//                'username' => $validation['email'],
//                'otp_code' => $otp,
//                'otp_expires_at' => now()->addMinutes(10),
//            ]);
//
//            session()->put('auth', ['admin' => [
//                'user_id' => $user->id,
//                'verification_id' => $verification->id,
//            ]]);
//
//            $data = [
//                'success' => 'Verification sent!',
//            ];
//
//            return to_route('admin.auth.verify')
//                ->with($data);
//        } else {
//            session()->put('auth', ['guest_admin' => ['email' => $validation['email']]]);
//            $data = [
//                'email' => session()->get('auth')['guest_admin']['email'],
//            ];
//
//            return to_route('admin.auth.register')
//                ->with($data);
//        }
//    }

}
