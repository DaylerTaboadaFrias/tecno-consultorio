<?php

namespace App\Models;

use App\Models\User;
use App\Models\Plataforma;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Antecedente extends Model
{
    use HasFactory;

    protected $table = "antecedentes_bucales";
    public $timestamps = false;

    
}
