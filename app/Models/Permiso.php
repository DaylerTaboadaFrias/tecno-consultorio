<?php

namespace App\Models;

use App\Models\User;
use App\Models\Grupo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permiso extends Model
{
    use HasFactory;
    protected $table = 'permiso';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grup_cod', 'grup_cod');
    }
}
