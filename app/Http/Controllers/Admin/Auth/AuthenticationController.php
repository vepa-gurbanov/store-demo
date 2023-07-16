<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Verification;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Illuminate\Support\Facades\Validator;


class AuthenticationController extends Controller
{
    public function stepOne() {
        session()->has('auth') ?? session()->forget('auth');
        return view('admin.auth.check');
    }


    public function check(Request $request) {
        $validation = $request->validate([
            'email' => ['required', 'string', 'email']
        ]);

        $user = User::where('email', $validation['email'])->first();
        if ($user) {

            $otp = rand(10000, 99999);
            $verification = Verification::create([
                'username' => $validation['email'],
                'code' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            session()->put('auth', ['admin' => [
                'user_id' => $user->id,
                'verification_id' => $verification->id,
                'email' => $validation['email'],
            ]]);

            $data = [
                'success' => 'Verification sent!',
                'email' => $validation['email'],

            ];

            return to_route('admin.auth.verify')
                ->with($data);
        } else {
            session()->put('auth', ['guest_admin' => ['email' => $validation['email']]]);
            $data = [
                'email' => session()->get('auth')['guest_admin']['email'],
            ];

            return to_route('admin.auth.register')
                ->with($data);
        }
    }


    public function stepTwo() {
            session()->has('attempted') ?? session()->forget('attempted');
        return view('admin.auth.verify');
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function verify(Request $request)
    {
        $validation = $request->validate(['otp_code' => ['required', 'integer', 'between:10000,99999']]);

        $code = intval($validation['otp_code']);

        $session = session()->get('auth');

        $verification_id = isset(session()->get('auth')['admin']) ? 'admin' : 'guest_admin';

        $verification = Verification::where('id', $session[$verification_id]['verification_id'])->first();

        $validated = intval($verification->code) === $code && $verification->otp_expires_at->format('Y-m-d H:i') > now()->format('Y-m-d H:i');

        if ($verification && $validated) {

            if (array_key_exists('guest_admin', $session)) {
                $user = User::create([
                    'name' => $session['guest_admin']['name'],
                    'email' => $session['guest_admin']['email'],
                    'password' => bcrypt($code),
                ]);

                return to_route('admin.auth.wait');

            } else {
                $user = User::where('id', $session['admin']['user_id'])->first();
            }
            Auth::guard('web')->login($user);

            $verification->update(['status' => 1]);

            session()->forget('auth');

            $data = [
                'success' => 'Logged in!',
            ];

            return to_route(RouteServiceProvider::__DASHBOARD)
                ->with($data);

        } elseif (intval($verification->code) != $code && $verification->otp_expires_at > now()) {

            $verification->attempts ++;

            $verification->update();

            if ($verification->attempts >= 3) {
                session()->put('attempted', $session[$verification_id]['email']);
                session()->forget('auth');
                $data = [
                    'error' => 'Too many attempts!',
                ];
                return to_route('admin.auth.check')
                    ->with($data);
            }
            $data = [
                'error' => 'Verification code incorrect!',
            ];
            return back()
                ->with($data);
        } elseif($verification->otp_expires_at <= now()) {
            session()->put('attempted', $session[$verification_id]['email']);
            session()->forget('auth');
            $data = [
                'error' => 'Verification code expired!',
            ];
            return to_route('admin.auth.check')
                ->with($data);
        }

        // End
    }


    public function resend() {
        $session = session()->get('auth');
//        if (isset($session)
    }


    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session()->forget('auth');

        session()->forget('attempted');

        return to_route('admin.auth.check');
    }
}
