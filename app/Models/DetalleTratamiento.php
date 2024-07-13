<?php

namespace App\Models;

use App\Models\User;
use App\Models\Consulta;
use App\Models\Servicio;
use App\Models\Plataforma;
use App\Models\Tratamiento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleTratamiento extends Model
{
    use HasFactory;

    protected $table = "detalle_tratamiento";
    public $timestamps = false;

    // public function getImagenMovilAttribute()
    // {
    //     return env('APP_URL').'/images/'.$this->imagen;
    // }
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }
    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'id_tratamiento');
    }
}
