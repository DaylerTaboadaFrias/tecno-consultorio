<?php

namespace App\Models;

use App\Models\User;
use App\Models\Consulta;
use App\Models\Plataforma;
use App\Models\Medicamento;
use App\Models\Tratamiento;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receta extends Model
{
    use HasFactory;

    protected $table = "recetas";
    public $timestamps = false;

    // public function getImagenMovilAttribute()
    // {
    //     return env('APP_URL').'/images/'.$this->imagen;
    // }
    public function tratamiento()
    {
        return $this->belongsTo(Tratamiento::class, 'id_tratamiento');
    }
    public function medicamentos()
    {
        return $this->belongsToMany(Medicamento::class, 'detalle_receta', 'id_receta', 'id_medicamento')
                    ->withPivot('horafrecuencia');
    }
}
