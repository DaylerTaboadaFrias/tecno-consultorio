<?php

namespace App\Models;

use App\Models\User;
use App\Models\Consulta;
use App\Models\Plataforma;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tratamiento extends Model
{
    use HasFactory;

    protected $table = "tratamientos";
    public $timestamps = false;

    // public function getImagenMovilAttribute()
    // {
    //     return env('APP_URL').'/images/'.$this->imagen;
    // }
    public function consulta()
    {
        return $this->belongsTo(Consulta::class, 'id_consulta');
    }
    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'detalle_tratamiento', 'id_tratamiento', 'id_servicio')
                    ->withPivot('cantidad', 'pieza', 'estado');
    }
}
