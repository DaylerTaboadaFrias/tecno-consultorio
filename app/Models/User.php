<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\Role;
use App\Models\Permiso;
use App\Models\Configuracion;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'usuarios';
    protected $fillable = [
        'nombre', 'email', 'password'
   ];
   
   public $timestamps = false;
   public function configuracion()
    {
        return $this->hasOne(Configuracion::class, 'id_usuario', 'id');
    }
    public function permisos()
    {
        return $this->hasMany(Permiso::class, 'id_usuario');
    }
}
