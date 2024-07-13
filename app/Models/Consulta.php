<?php

namespace App\Models;

use App\Models\User;
use App\Models\Consulta;
use App\Models\Plataforma;
use App\Models\Antecedente;
use App\Models\Tratamiento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consulta extends Model
{
    use HasFactory;

    protected $table = "consultas";
    public $timestamps = false;

    // public function getImagenMovilAttribute()
    // {
    //     return env('APP_URL').'/images/'.$this->imagen;
    // }

     public function cliente()
     {
         return $this->belongsTo(User::class, 'id_cliente');
     }
     public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class,'id_consulta');
    }
    public function antecedente()
    {
        return $this->hasMany(Antecedente::class, 'id_consulta');
    }
}
