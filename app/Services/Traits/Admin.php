<?php

namespace App\Services\Traits;

use App\Models\User;
use App\Models\Verification;
use App\Notifications\AdminOtpVerificationNotification;
use Illuminate\Support\Facades\Auth;

trait Admin
{
    public function createVerificationCode(Verification $verification): string
    {
        $otp = rand(10000, 99999);
        $verification->otp_code = $otp;
        $verification->otp_expires_at = now()->addMinutes(10);
        $verification->save();
        return $verification->id;
    }

    public function validateVerificationCode($session, $validation): int
    {
        $verification = Verification::where('id', $session['verification_id'])->exists();
        $validated = $verification->otp_code === $validation['otp_code'] && $verification->otp_expires_at > now();
        if ($verification && $validated) {

            if (array_key_exists('guest_admin', $session)) {
                $user = User::create([
                    'name' => $session['guest_admin']['name'],
                    'email' => $session['guest_admin']['email'],
                    'password' => bcrypt($validation['otp_code']),
                ]);
            } else {
                $user = User::where('email', $validation['email'])->first();
            }
            Auth::guard('web')->login($user);
            $verification->update(['status' => 1]);
            session()->forget('auth');

            return 1;
        } elseif ($verification->otp_code != $validation['otp_code'] && $verification->otp_expires_at > now()) {
            return 0;
        } else {
            return 2;
        }
    }


    public function sendAdminVerificationNotification(Verification $verification, User $user): void
    {
        $this->createVerificationCode($verification);
        $this->notify(new AdminOtpVerificationNotification($verification, $user));
    }

}
