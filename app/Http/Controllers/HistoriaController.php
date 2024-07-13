<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Vista;
use App\Models\Cuenta;
use App\Models\Consulta;
use App\Models\Servicio;
use App\Models\Plataforma;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HistoriaController extends Controller
{
    public function index(Request $request)
    {
        $clientes = User::where('tipo','Cliente')->where('nombre','ilike','%'.$request->campo.'%')->get();
        $vista = Vista::where('nombre_vista','historia.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'historia.index';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('historia.index', ['clientes' => $clientes,'vista' => $vista]);
    }

    public function show($id)
    {
        $consultas = Consulta::with(['tratamientos' => function($query) {
            $query->where('tratamientos.estado', '!=', 'Eliminado')->with(['servicios' => function($query) {
                $query->where('servicios.estado', '!=', 'Eliminado');
            }]);
        }])->where('consultas.estado', '!=', 'Eliminado')->where('id_cliente', $id)->orderBy('id','DESC')->get();
        $vista = Vista::where('nombre_vista','historia.show')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'historia.show';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('historia.show', ['consultas' => $consultas,'vista' => $vista]);
    }


}
