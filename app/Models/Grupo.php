<?php

namespace App\Models;

use App\Models\Modulo;
use App\Models\Permiso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    protected $table = 'grupo';

    // Relación con módulos
    public function modulos()
    {
        return $this->belongsToMany(Modulo::class, 'mod_grup', 'grup_cod', 'mod_cod')
        ->where('mod_grup.mod_grup_fins', '>=', now()->toDateString())
        ->where('modulo.mod_est', true) ;
    }
}
