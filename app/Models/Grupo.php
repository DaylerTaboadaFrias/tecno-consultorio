<?php

namespace App\Models;

use App\Models\User;
use App\Models\Modulo;
use App\Models\Permiso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grupo extends Model
{
    protected $table = 'grupo';
    protected $primaryKey = 'grup_cod';
    protected $keyType = 'string';
    // Relación con módulos
    public function modulos()
    {
        return $this->belongsToMany(Modulo::class, 'mod_grup', 'grup_cod', 'mod_cod')
        ->where('mod_grup.mod_grup_fins', '>=', now()->toDateString())
        ->where('modulo.mod_est', true) ;
    }
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'permiso', 'grup_cod', 'id_usuario')
                    ->withPivot('perm_pass', 'perm_fini', 'permffin', 'permest');
    }
}
