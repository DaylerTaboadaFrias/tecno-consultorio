<?php

namespace App\Models;

use App\Models\User;
use App\Models\Receta;
use App\Models\Consulta;
use App\Models\Servicio;
use App\Models\Plataforma;
use App\Models\Medicamento;
use App\Models\Tratamiento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetalleReceta extends Model
{
    use HasFactory;

    protected $table = "detalle_receta";
    public $timestamps = false;

    // public function getImagenMovilAttribute()
    // {
    //     return env('APP_URL').'/images/'.$this->imagen;
    // }
    public function medicamento()
    {
        return $this->belongsTo(Medicamento::class, 'id_medicamento');
    }
    public function receta()
    {
        return $this->belongsTo(Receta::class, 'id_receta');
    }
}
