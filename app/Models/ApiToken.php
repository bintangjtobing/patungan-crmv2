<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    use HasFactory;

    protected $table = 'api_tokens';

    // Optional, jika ingin menentukan kolom mana yang boleh diisi secara massal
    protected $fillable = ['user_id', 'token', 'expires_at'];
}
