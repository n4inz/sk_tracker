<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jawaban(){
        return $this->hasMany(PertanyaanJawaban::class,'pertanyaans_id');
    }
}
