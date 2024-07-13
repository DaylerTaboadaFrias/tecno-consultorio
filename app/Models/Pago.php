<?php

namespace App\Models;

use App\Models\User;
use App\Models\Plataforma;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pago extends Model
{
    use HasFactory;

    protected $table = "pagos";
    public $timestamps = false;

    // public function getImagenMovilAttribute()
    // {
    //     return env('APP_URL').'/images/'.$this->imagen;
    // }

     public function tratamiento()
     {
         return $this->belongsTo(Tratamiento::class, 'id_tratamiento');
     }
}
