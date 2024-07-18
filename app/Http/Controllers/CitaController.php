<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\User;

use App\Models\Vista;
use App\Models\Antecedente;
use App\Models\Tratamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with('cliente','tratamiento')->where('estado','!=','Eliminado')->orderBy('id', 'desc')->paginate(10);
        $vista = Vista::where('nombre_vista','cita.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'cita.index';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('cita.index', ['citas' => $citas,'vista' => $vista]);
    }
    
    public function create()
    {
        $clientes = User::where('tipo','Cliente')->where('estado','!=','Eliminado')->get();
        $tratamientos = Tratamiento::where('estado','!=','Eliminado')->get();
        $vista = Vista::where('nombre_vista','cita.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'cita.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('cita.create', ['clientes' => $clientes,'tratamientos' => $tratamientos,'vista' => $vista]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'notas' => 'required',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'horafin' => 'required',
            'tipo' => 'required|string|in:Tratamiento,Consulta',
            'id_cliente' => 'required_if:tipo,Consulta|nullable|exists:consultas,id',
            'id_tratamiento' => 'required_if:tipo,Tratamiento|nullable|exists:tratamientos,id',
            'hora' => 'required|date_format:H:i',
            'horafin' => 'required|date_format:H:i|after:hora',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if($request->input('tipo') == 'Tratamiento'){
            $cita = new Cita();
            $cita->fecha = $request->input('fecha');
            $cita->hora = $request->input('hora');
            $cita->horafin = $request->input('horafin');
            $cita->notas = $request->input('notas');
            $cita->tipo = $request->input('tipo');
            $cita->id_tratamiento = $request->input('id_tratamiento');
            $cita->save();
        }else if($request->input('tipo') == 'Consulta'){
            $cita = new Cita();
            $cita->fecha = $request->input('fecha');
            $cita->hora = $request->input('hora');
            $cita->horafin = $request->input('horafin');
            $cita->notas = $request->input('notas');
            $cita->tipo = $request->input('tipo');
            $cita->id_cliente = $request->input('id_cliente');
            $cita->save();
        }
        
        Session::flash('status', 'Registro guardado exitosamente!');
        return redirect()->route('cita.index');
    }
    
    
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->estado ='Eliminado';
        $cita->update();
        Session::flash('status', 'Registro eliminado exitosamente!');
        return redirect()->route('cita.index');
    }

}
