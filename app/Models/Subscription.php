<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Subscription extends BaseModel
{
    use HasFactory;
    protected $tabel = 'products';
}