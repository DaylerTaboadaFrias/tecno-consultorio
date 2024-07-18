<?php

namespace App\Http\Controllers;

use App\Models\Cita;

use App\Models\Pago;
use App\Models\User;
use App\Models\Vista;
use App\Models\Cuenta;
use App\Models\Receta;
use App\Models\Consulta;
use App\Models\Servicio;
use App\Models\Plataforma;
use App\Models\Medicamento;
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
        $url = "https://mail.tecnoweb.org.bo/inf513/grupo14sc/tecno-consultorio/public/";
        //$url = "http://127.0.0.1:8000/";
        $consultas = $consultas->map(function ($consulta) use ($request,$url) {
            $consulta->descripcion_referencia = 'Se encontró una referencia '.$consulta->motivo.' similar a '.$request->campo.'en la tabla de consultas';
            $consulta->caso_uso = 'Gestionar consultas';
            $consulta->url = $url.'consulta/'.$consulta->id.'/edit/';
            return $consulta;
        });
        $medicamentos = Medicamento::where('nombre','ilike','%'.$request->campo.'%')->get();
        $medicamentos = $medicamentos->map(function ($medicamento) use ($request,$url) {
            $medicamento->descripcion_referencia = 'Se encontró una referencia '.$medicamento->nombre.' similar a '.$request->campo.'en la tabla de medicamentos';
            $medicamento->caso_uso = 'Gestionar medicamentos';
            $medicamento->url = $url.'medicamento/'.$medicamento->id.'/edit/';
            return $medicamento;
        });
        $recetas = Receta::where('recomendacion','ilike','%'.$request->campo.'%')->get();
        $recetas = $recetas->map(function ($receta) use ($request,$url) {
            $receta->descripcion_referencia = 'Se encontró una referencia '.$receta->recomendacion.' similar a '.$request->campo.'en la tabla de recetas';
            $receta->caso_uso = 'Gestionar recetas';
            $receta->url = $url.'receta/detalle/'.$receta->id;
            return $receta;
        });
        $citas = Cita::where('notas','ilike','%'.$request->campo.'%')->get();
        $citas = $citas->map(function ($cita) use ($request,$url) {
            $cita->descripcion_referencia = 'Se encontró una referencia '.$cita->notas.' similar a '.$request->campo.'en la tabla de citas';
            $cita->caso_uso = 'Gestionar citas';
            $cita->url = $url.'cita/';
            return $cita;
        });
        $pagos = Pago::where('notas','ilike','%'.$request->campo.'%')->get();
        $pagos = $pagos->map(function ($pago) use ($request,$url) {
            $pago->descripcion_referencia = 'Se encontró una referencia '.$pago->notas.' similar a '.$request->campo.'en la tabla de pagos';
            $pago->caso_uso = 'Gestionar pago';
            $pago->url = $url.'pago/';
            return $pago;
        });
        $servicios = Servicio::where('nombre','ilike','%'.$request->campo.'%')->get();
        $servicios = $servicios->map(function ($servicio)  use ($request,$url){
            $servicio->descripcion_referencia = 'Se encontró una referencia '.$servicio->nombre.' similar a '.$request->campo.'en la tabla de servicios';
            $servicio->caso_uso = 'Gestionar servicios';
            $servicio->url = $url.'servicio/'.$servicio->id.'/edit/';
            return $servicio;
        });
        $tratamientos = Tratamiento::where('descripcion','ilike','%'.$request->campo.'%')->get();
        $tratamientos = $tratamientos->map(function ($tratamiento)  use ($request,$url){
            $tratamiento->descripcion_referencia = 'Se encontró una referencia '.$tratamiento->nombre.' similar a '.$request->campo.'en la tabla de tratamientos';
            $tratamiento->caso_uso = 'Gestionar tratamientos';
            $tratamiento->url = $url.'tratamiento/detalle/'.$tratamiento->id;
            return $tratamiento;
        });
        $usuarios = User::where('nombre','ilike','%'.$request->campo.'%')->get();
        $usuarios = $usuarios->map(function ($usuario) use ($request,$url) {
            $usuario->descripcion_referencia = 'Se encontró una referencia '.$usuario->motivo.' similar a '.$request->campo.'en la tabla de usuarios';
            $usuario->caso_uso = 'Gestionar usuarios';
            $usuario->url = $url.'usuario/'.$usuario->id.'/edit/';
            return $usuario;
        });
        $mergedResults = $consultas->merge($servicios,$tratamientos);
        $mergedResults = $mergedResults->merge($tratamientos);
        $mergedResults = $mergedResults->merge($usuarios);
        $mergedResults = $mergedResults->merge($pagos);
        $mergedResults = $mergedResults->merge($citas);
        $mergedResults = $mergedResults->merge($usuarios);
        $mergedResults = $mergedResults->merge($recetas);
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
        return view('buscador.index', ['referencias' => $mergedResults->take(10),'vista' => $vista]);
    }

    

}
