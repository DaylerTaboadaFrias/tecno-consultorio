<?php

namespace App\Models;

use App\Models\Plataforma;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = "configuraciones";
    public $timestamps = false;

}
