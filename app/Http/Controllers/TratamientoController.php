<?php

namespace App\Http\Controllers;

use App\Models\Vista;
use App\Models\Consulta;

use App\Models\Servicio;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use App\Models\DetalleTratamiento;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TratamientoController extends Controller
{
    public function index()
    {
        $tratamientos = Tratamiento::with('consulta.cliente')->where('estado','!=','Eliminado')->orderBy('id', 'desc')->paginate(10);
        $vista = Vista::where('nombre_vista','tratamiento.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'tratamiento.index';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('tratamiento.index', ['tratamientos' => $tratamientos,'vista' => $vista]);
    }
    public function detalle($idTratamiento)
    {
        $detallesTratamiento = DetalleTratamiento::with('servicio')->where('id_tratamiento',$idTratamiento)->where('estado','!=','Eliminado')->paginate(10);
        $vista = Vista::where('nombre_vista','tratamiento.detalle')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'tratamiento.detalle';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('tratamiento.detalle', ['detallesTratamiento' => $detallesTratamiento,'vista' => $vista]);
    }
    public function create()
    {
        $consultas = Consulta::with('cliente')->where('estado','!=','Eliminado')->get();
        $servicios = Servicio::where('estado','!=','Eliminado')->get();
        $vista = Vista::where('nombre_vista','tratamiento.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'tratamiento.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('tratamiento.create', ['consultas' => $consultas,'servicios' => $servicios,'vista' => $vista]);
    }
    public function store(Request $request)
    {
        $messages = [
            'servicios.*.pieza.required' => 'La pieza es obligatoria.',
        ];
        $data = $request->validate([
            'fecha' => 'required',
            'id_consulta' => 'required',
            'servicios.*.pieza' => 'required|string|max:255',
            'servicios.*.id' => 'required|string|max:255',
        ], $messages);
        $tratamiento = new Tratamiento();
        $tratamiento->fecha = $request->input('fecha');
        $tratamiento->descripcion = $request->input('descripcion');
        $tratamiento->id_consulta = $request->input('id_consulta');
        $tratamiento->save();
        foreach ($data['servicios'] as $servicio) {
            $tratamiento->servicios()->attach($servicio['id'], [
                'pieza' => $servicio['pieza']
            ]);
        }
        Session::flash('status', 'Registro guardado exitosamente!');
        return redirect()->route('tratamiento.index');
    }
    
    public function destroy($id)
    {
        $tratamiento = Tratamiento::findOrFail($id);
        $tratamiento->estado ='Eliminado';
        $tratamiento->update();
        Session::flash('status', 'Registro eliminado exitosamente!');
        return redirect()->route('tratamiento.index');
    }

    
}
