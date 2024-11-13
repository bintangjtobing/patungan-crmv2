<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'status',
        'subject',
        'body',
        'tanggal_waktu_terkirim'
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

}
