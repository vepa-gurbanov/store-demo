<?php

namespace App\Services\Contracts;

use App\Models\User;
use App\Models\Verification;

interface Admin
{
    public function createVerificationCode(Verification $verification);
    public function validateVerificationCode($session, $validation);
    public function sendAdminVerificationNotification(Verification $verification, User $user);
}
