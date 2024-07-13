<?php

namespace App\Models;

use App\Models\Cuenta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Perfil extends Model
{
    use HasFactory;

    protected $table = "perfiles";
    public $timestamps = false;

    // public function getImagenMovilAttribute()
    // {
    //     return env('APP_URL').'/images/'.$this->imagen;
    // }

     public function cuenta()
     {
         return $this->belongsTo(Cuenta::class, 'id_cuenta');
     }
}
