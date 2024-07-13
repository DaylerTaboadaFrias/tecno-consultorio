<?php

namespace App\Models;

use App\Models\User;
use App\Models\Plataforma;
use App\Models\Tratamiento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;

    protected $table = "citas";
    public $timestamps = false;

    // public function getImagenMovilAttribute()
    // {
    //     return env('APP_URL').'/images/'.$this->imagen;
    // }

     public function tratamiento()
     {
         return $this->belongsTo(Tratamiento::class, 'id_tratamiento');
     }
     public function cliente()
     {
         return $this->belongsTo(User::class, 'id_cliente');
     }
}
