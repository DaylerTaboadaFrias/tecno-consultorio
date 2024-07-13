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

class BuscadorController extends Controller
{
    public function index(Request $request)
    {
        $consultas = Consulta::where('motivo','ilike','%'.$request->campo.'%')->get();
        $consultas = $consultas->map(function ($consulta) use ($request) {
            $consulta->descripcion_referencia = 'Se encontró una referencia '.$consulta->motivo.' similar a '.$request->campo.'en la tabla de plataformas';
            $consulta->caso_uso = 'Gestionar consultas';
            $consulta->url = 'http://127.0.0.1:8000/consulta/'.$consulta->id.'/edit/';
            return $consulta;
        });
        $servicios = Servicio::where('nombre','ilike','%'.$request->campo.'%')->get();
        $servicios = $servicios->map(function ($servicio)  use ($request){
            $servicio->descripcion_referencia = 'Se encontró una referencia '.$servicio->nombre.' similar a '.$request->campo.'en la tabla de servicios';
            $servicio->caso_uso = 'Gestionar servicios';
            $servicio->url = 'http://127.0.0.1:8000/servicio/'.$servicio->id.'/edit/';
            return $servicio;
        });
        $tratamientos = Tratamiento::where('descripcion','ilike','%'.$request->campo.'%')->get();
        $tratamientos = $tratamientos->map(function ($tratamiento)  use ($request){
            $tratamiento->descripcion_referencia = 'Se encontró una referencia '.$tratamiento->nombre.' similar a '.$request->campo.'en la tabla de tratamientos';
            $tratamiento->caso_uso = 'Gestionar tratamientos';
            $tratamiento->url = 'http://127.0.0.1:8000/tratamiento/'.$tratamiento->id.'/edit/';
            return $tratamiento;
        });
        $usuarios = User::where('nombre','ilike','%'.$request->campo.'%')->get();
        $usuarios = $usuarios->map(function ($usuario) use ($request) {
            $usuario->descripcion_referencia = 'Se encontró una referencia '.$usuario->motivo.' similar a '.$request->campo.'en la tabla de usuarios';
            $usuario->caso_uso = 'Gestionar usuarios';
            $usuario->url = 'http://127.0.0.1:8000/usuario/'.$usuario->id.'/edit/';
            return $usuario;
        });
        $mergedResults = $consultas->merge($servicios,$tratamientos);
        $mergedResults = $mergedResults->merge($tratamientos);
        $mergedResults = $mergedResults->merge($usuarios);
        $vista = Vista::where('nombre_vista','buscador.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'buscador.index';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('buscador.index', ['referencias' => $mergedResults,'vista' => $vista]);
    }

    

}
