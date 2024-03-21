<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $fillable = [
        'email',
        'otp',
    ];
    public function profile(): HasOne{
        return $this->hasOne(CustomerProfile::class);
    }
}
