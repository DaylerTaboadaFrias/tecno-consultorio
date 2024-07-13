<?php

namespace App\Http\Controllers;

use auth;

use App\Models\Vista;
use App\Models\Cuenta;
use App\Models\Plataforma;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ConfiguracionController extends Controller
{
    public function index(Request $request)
    {
        $configuracion = Configuracion::where('id_usuario',auth()->user()->id)->first();
        $vista = Vista::where('nombre_vista','configuracion.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'configuracion.index';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('configuracion.index', ['configuracion' => $configuracion,'vista' => $vista]);
    }

    public function store(Request $request)
    {
        $configuracion = Configuracion::where('id_usuario',auth()->user()->id)->first();
        $configuracion->modo = $request->input('modos');
        $configuracion->tema = $request->input('temas');
        $configuracion->save();
        return redirect()->route('configuracion.index');

    }

}
