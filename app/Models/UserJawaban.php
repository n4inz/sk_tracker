<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJawaban extends Model
{
    CONST NEW = 1;
    use HasFactory;
    protected $guarded = ['id'];
}
