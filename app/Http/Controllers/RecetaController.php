<?php

namespace App\Http\Controllers;

use App\Models\Vista;
use App\Models\Tratamiento;

use App\Models\Medicamento;
use App\Models\Receta;
use Illuminate\Http\Request;
use App\Models\DetalleReceta;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RecetaController extends Controller
{
    public function index()
    {
        $recetas = Receta::with('tratamiento.consulta.cliente')->where('estado','!=','Eliminado')->orderBy('id', 'desc')->paginate(10);
        $vista = Vista::where('nombre_vista','receta.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'receta.index';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('receta.index', ['recetas' => $recetas,'vista' => $vista]);
    }
    public function detalle($idReceta)
    {
        $detallesReceta = DetalleReceta::with('medicamento')->where('id_receta',$idReceta)->where('estado','!=','Eliminado')->paginate(10);
        $vista = Vista::where('nombre_vista','receta.detalle')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'receta.detalle';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('receta.detalle', ['detallesReceta' => $detallesReceta,'vista' => $vista]);
    }
    public function create()
    {
        $tratamientos = Tratamiento::with('consulta.cliente')->where('estado','!=','Eliminado')->get();
        $medicamentos = Medicamento::where('estado','!=','Eliminado')->get();
        $vista = Vista::where('nombre_vista','receta.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'receta.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('receta.create', ['tratamientos' => $tratamientos,'medicamentos' => $medicamentos,'vista' => $vista]);
    }
    public function store(Request $request)
    {
        $messages = [
            'medicamentos.*.horafrecuencia.required' => 'La horafrecuencia es obligatoria.',
        ];
        $data = $request->validate([
            'fecha' => 'required',
            'id_tratamiento' => 'required',
            'medicamentos.*.horafrecuencia' => 'required|string|max:255',
            'medicamentos.*.id' => 'required|string|max:255',
        ], $messages);
        $receta = new Receta();
        $receta->fecha = $request->input('fecha');
        $receta->recomendacion = $request->input('recomendacion');
        $receta->id_tratamiento = $request->input('id_tratamiento');
        $receta->save();
        foreach ($data['medicamentos'] as $servicio) {
            $receta->medicamentos()->attach($servicio['id'], [
                'horafrecuencia' => $servicio['horafrecuencia']
            ]);
        }
        Session::flash('status', 'Registro guardado exitosamente!');
        return redirect()->route('receta.index');
    }
   
    public function destroy($id)
    {
        $receta = Receta::findOrFail($id);
        $receta->estado ='Eliminado';
        $receta->update();
        Session::flash('status', 'Registro eliminado exitosamente!');
        return redirect()->route('receta.index');
    }

}
