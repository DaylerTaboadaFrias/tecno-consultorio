<?php

namespace App\Models;

use App\Models\Grupo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modulo extends Model
{
    use HasFactory;
    protected $table = 'modulo';

    // Relación con grupos
    public function grupos()
    {
        return $this->belongsToMany(Grupo::class, 'mod_grup', 'mod_cod', 'grup_cod')
            ->withPivot('mod_grup_fins')
            ->wherePivot('mod_grup_fins', '>=', now()->toDateString());
    }
    
}
