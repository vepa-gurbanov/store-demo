<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];


    protected $casts = [
        'otp_expires_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

}
