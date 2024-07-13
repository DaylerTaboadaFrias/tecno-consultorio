<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vista;

use App\Models\Consulta;
use App\Models\Antecedente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ConsultaController extends Controller
{
    public function index()
    {
        $consultas = Consulta::with('cliente')->where('estado','!=','Eliminado')->paginate(10);
        $vista = Vista::where('nombre_vista','consulta.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'consulta.index';
            $vista->contador = 1;
            $vista->save(); 
        }

        return view('consulta.index', ['consultas' => $consultas,'vista' => $vista]);
    }
    public function editAntecedente($id)
    {
        $form = Antecedente::where('id_consulta',$id)->first();
        $consultas = Consulta::all(); 
        $vista = Vista::where('nombre_vista','consulta.edit-antecedente')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'consulta.edit-antecedente';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('consulta.edit-antecedente', ['vista' => $vista,'form' => $form,'consultas' => $consultas]);
    }

    public function updateAntecedente(Request $request, $id){
        $validatedData = $request->validate([
            'id_consulta' => 'nullable|exists:consultas,id',
            'antecedentes_patologicos' => 'nullable|array',
            'observaciones' => 'nullable|string',
            'tratamiento_medico' => 'nullable|string',
            'embarazo' => 'nullable|string',
            'hemorragia_post_exodoncia' => 'nullable|string',
            'medicacion' => 'nullable|string',
            'tiempo_gestacion' => 'nullable|string',
            'inmediata' => 'nullable|boolean',
            'mediata' => 'nullable|boolean',
            'cepillado_veces' => 'nullable|string',
            'cepillado_frecuencia' => 'nullable|string',
            'cepillado_sangrado_encias' => 'nullable|string|in:Si,No',
            'uso_hilo_dental' => 'nullable|string|in:Si,No',
        ]);
        $form = Antecedente::findOrFail($id);
        $form->id_consulta = $validatedData['id_consulta'] ?? $form->id_consulta;
        $form->antecedentes_patologicos = isset($validatedData['antecedentes_patologicos']) ? implode(',', $validatedData['antecedentes_patologicos']) : $form->antecedentes_patologicos;
        $form->observaciones = $validatedData['observaciones'] ?? $form->observaciones;
        $form->tratamiento_medico = $validatedData['tratamiento_medico'] ?? $form->tratamiento_medico;
        $form->embarazo = $validatedData['embarazo'] ?? $form->embarazo;
        $form->hemorragia_post_exodoncia = $validatedData['hemorragia_post_exodoncia'] ?? $form->hemorragia_post_exodoncia;
        $form->medicacion = $validatedData['medicacion'] ?? $form->medicacion;
        $form->tiempo_gestacion = $validatedData['tiempo_gestacion'] ?? $form->tiempo_gestacion;
        $form->inmediata = $validatedData['inmediata'] ?? $form->inmediata;
        $form->mediata = $validatedData['mediata'] ?? $form->mediata;
        $form->cepillado_veces = $validatedData['cepillado_veces'] ?? $form->cepillado_veces;
        $form->cepillado_frecuencia = $validatedData['cepillado_frecuencia'] ?? $form->cepillado_frecuencia;
        $form->cepillado_sangrado_encias = isset($validatedData['cepillado_sangrado_encias']) ? $validatedData['cepillado_sangrado_encias'] == 'Si' : $form->cepillado_sangrado_encias;
        $form->uso_hilo_dental = isset($validatedData['uso_hilo_dental']) ? $validatedData['uso_hilo_dental'] == 'Si' : $form->uso_hilo_dental;
        $form->save();
        Session::flash('status', 'Registro editado exitosamente!');
        return redirect()->route('consulta.index');
    }
    public function create()
    {
        $clientes = User::where('tipo','Cliente')->where('estado','!=','Eliminado')->get();
        $vista = Vista::where('nombre_vista','consulta.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'consulta.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('consulta.create', ['clientes' => $clientes,'vista' => $vista]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'motivo' => 'required|string|min:5|max:30',
            'fecha' => 'required',
            'id_cliente' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $consulta = new Consulta();
        $consulta->fecha = $request->input('fecha');
        $consulta->motivo = $request->input('motivo');
        $consulta->diagnostico = $request->input('diagnostico');
        $consulta->id_cliente = $request->input('id_cliente');
        $consulta->save();
        $antecedente = new Antecedente();
        $antecedente->id_consulta=$consulta->id;
        $antecedente->save();
        Session::flash('status', 'Registro guardado exitosamente!');
        return redirect()->route('consulta.index');
    }
    public function edit($id)
    {
        $consulta = Consulta::findOrFail($id);
        $clientes = User::where('tipo','Cliente')->where('estado','!=','Eliminado')->get();
        $vista = Vista::where('nombre_vista','consulta.edit')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'consulta.edit';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('consulta.edit', ['consulta' => $consulta, 'clientes' => $clientes,'vista' => $vista]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'motivo' => 'required|string|min:5|max:150',
            'fecha' => 'required',
            'id_cliente' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $consulta = Consulta::findOrFail($id);
        $consulta->fecha = $request->input('fecha');
        $consulta->motivo = $request->input('motivo');
        $consulta->diagnostico = $request->input('diagnostico');
        $consulta->id_cliente = $request->input('id_cliente');
        $consulta->save();
        Session::flash('status', 'Registro editado exitosamente!');
        return redirect()->route('consulta.index');
    }

    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->estado ='Eliminado';
        $consulta->update();
        Session::flash('status', 'Registro eliminado exitosamente!');
        return redirect()->route('consulta.index');
    }

}
