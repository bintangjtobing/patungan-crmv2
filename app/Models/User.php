<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'alamat',
        'email',
        'type',
        'no_hp',
        'is_active',
        'profile_picture',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
        'type' => 'boolean',
    ];
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }
    public function kredentialCustomers()
    {
        return $this->hasMany(KredentialCustomer::class, 'user_id', 'id');
    }
}