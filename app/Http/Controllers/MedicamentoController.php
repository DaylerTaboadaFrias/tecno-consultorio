<?php

namespace App\Http\Controllers;

use App\Models\Vista;

use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MedicamentoController extends Controller
{
    public function index()
    {
        $medicamentos = Medicamento::where('estado','!=','Eliminado')->paginate(5);
        $vista = Vista::where('nombre_vista','medicamento.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'medicamento.index';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('medicamento.index', ['medicamentos' => $medicamentos,'vista' => $vista]);
    }

    public function create()
    {
        $vista = Vista::where('nombre_vista','medicamento.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'medicamento.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('medicamento.create', ['vista' => $vista]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|min:5|max:50',
            'marca' => 'required|string|min:5|max:100',
            'medida' => 'required|string|min:5|max:100',
            'tipo' => 'required|string|min:5|max:100',
            'imagen' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($image = $request->file('imagen')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['imagen'] = "$profileImage";
        }
        $medicamento = new Medicamento();
        $medicamento->nombre = $request->input('nombre');
        $medicamento->marca = $request->input('marca');
        $medicamento->medida = $request->input('medida');
        $medicamento->tipo = $request->input('tipo');
        $medicamento->imagen = $input['imagen'];
        $medicamento->save();
        Session::flash('status', 'Registro editado exitosamente!');
        return redirect()->route('medicamento.index');

    }
    public function edit($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $vista = Vista::where('nombre_vista','medicamento.edit')->first();
        
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'medicamento.edit';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('medicamento.edit', ['medicamento' => $medicamento,'vista' => $vista]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'marca' => 'required|string|max:100',
            'medida' => 'required|string|max:100',
            'tipo' => 'required|string|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->nombre = $request->input('nombre');
        $medicamento->marca = $request->input('marca');
        $medicamento->medida = $request->input('medida');
        $medicamento->tipo = $request->input('tipo');
        $medicamento->update();
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $fechaActual = now()->format('YmdHis');
            $nombreArchivo = $fechaActual . '_' . $archivo->getClientOriginalName();
            $validated['imagen'] = $nombreArchivo;
            $medicamento->imagen = $nombreArchivo;
            $medicamento->update();
            //$rutaArchivo = Storage::disk('public')->putFileAs('archivos', $archivo, $nombreArchivo);
            if ($medicamento->imagen != null) {
                File::delete(app_path() . '/images/' . $medicamento->imagen);
            }
            $request->file('imagen')->move('images/', $nombreArchivo);
        }

        Session::flash('status', 'Registro editado exitosamente!');
        return redirect()->route('medicamento.index');
    }
    public function destroy($id)
    {
        $medicamento = Medicamento::findOrFail($id);
        $medicamento->estado ='Eliminado';
        $medicamento->update();
        Session::flash('status', 'Registro eliminado exitosamente!');
        return redirect()->route('medicamento.index');
    }

}
