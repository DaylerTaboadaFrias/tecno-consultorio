<?php

namespace App\Http\Controllers;

use App\Models\Vista;

use App\Models\Plataforma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PlataformaController extends Controller
{
    public function index()
    {
        $plataformas = Plataforma::paginate(5);
        $vista = Vista::where('nombre_vista','plataforma.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'plataforma.index';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('plataforma.index', ['plataformas' => $plataformas,'vista' => $vista]);
    }

    public function create()
    {
        $vista = Vista::where('nombre_vista','plataforma.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'plataforma.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('plataforma.create', ['vista' => $vista]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'costo' => 'required|numeric|max:100',
            'cantidadperfiles' => 'required|integer|max:20',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $plataforma = new Plataforma();
        $plataforma->nombre = $request->input('nombre');
        $plataforma->costo = $request->input('costo');
        $plataforma->cantidadperfiles = $request->input('cantidadperfiles');
        $plataforma->save();
        return redirect()->route('plataforma.index');

    }
    public function edit($id)
    {
        $plataforma = Plataforma::findOrFail($id);
        $vista = Vista::where('nombre_vista','plataforma.edit')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'plataforma.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('plataforma.edit', ['plataforma' => $plataforma,'vista' => $vista]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'costo' => 'required|numeric|max:100',
            'cantidadperfiles' => 'required|integer|max:20',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $plataforma = Plataforma::findOrFail($id);
        $plataforma->nombre = $request->input('nombre');
        $plataforma->costo = $request->input('costo');
        $plataforma->cantidadperfiles = $request->input('cantidadperfiles');
        $plataforma->update();
        return redirect()->route('plataforma.index');
    }
    public function destroy($id)
    {
        $plataforma = Plataforma::findOrFail($id);
        $plataforma->delete();
        return redirect()->route('plataforma.index');
    }

}
