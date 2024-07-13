<?php

namespace App\Http\Controllers;

use App\Models\Vista;

use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServicioController extends Controller
{
    public function index()
    {
        $servicios = Servicio::where('estado','!=','Eliminado')->paginate(5);
        $vista = Vista::where('nombre_vista','servicio.index')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'servicio.index';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('servicio.index', ['servicios' => $servicios,'vista' => $vista]);
    }

    public function create()
    {
        $vista = Vista::where('nombre_vista','servicio.create')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'servicio.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('servicio.create', ['vista' => $vista]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'precio' => 'required|numeric|max:100000',
            'descripcion' => 'required|string|max:100',
            'imagen' => 'required',
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
        $servicio = new Servicio();
        $servicio->nombre = $request->input('nombre');
        $servicio->precio = $request->input('precio');
        $servicio->descripcion = $request->input('descripcion');
        $servicio->imagen = $input['imagen'];
        $servicio->save();
        Session::flash('status', 'Registro editado exitosamente!');
        return redirect()->route('servicio.index');

    }
    public function edit($id)
    {
        $servicio = Servicio::findOrFail($id);
        $vista = Vista::where('nombre_vista','servicio.edit')->first();
        // Incrementar el contador
        if ($vista) {
            $contador = $vista->contador + 1;
            $vista->contador = $contador;
            $vista->save();
        }else{
            $vista = new Vista;
            $vista->nombre_vista = 'servicio.create';
            $vista->contador = 1;
            $vista->save(); 
        }
        return view('servicio.edit', ['servicio' => $servicio,'vista' => $vista]);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'precio' => 'required|numeric|max:100000',
            'descripcion' => 'required|string|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $servicio = Servicio::findOrFail($id);
        $servicio->nombre = $request->input('nombre');
        $servicio->precio = $request->input('precio');
        $servicio->descripcion = $request->input('descripcion');
        $servicio->update();
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $fechaActual = now()->format('YmdHis');
            $nombreArchivo = $fechaActual . '_' . $archivo->getClientOriginalName();
            $validated['imagen'] = $nombreArchivo;
            $servicio->imagen = $nombreArchivo;
            $servicio->update();
            //$rutaArchivo = Storage::disk('public')->putFileAs('archivos', $archivo, $nombreArchivo);
            if ($servicio->imagen != null) {
                File::delete(app_path() . '/images/' . $servicio->imagen);
            }
            $request->file('imagen')->move('images/', $nombreArchivo);
        }

        Session::flash('status', 'Registro editado exitosamente!');
        return redirect()->route('servicio.index');
    }
    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);
        $servicio->estado ='Eliminado';
        $servicio->update();
        Session::flash('status', 'Registro eliminado exitosamente!');
        return redirect()->route('servicio.index');
    }

}
