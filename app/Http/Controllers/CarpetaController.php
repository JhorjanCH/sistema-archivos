<?php

namespace App\Http\Controllers;

use App\Models\Carpeta;
use Illuminate\Http\Request;

class CarpetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $carpetas = Carpeta::whereNull('carpeta_padre_id')->get();
        return view('admin.mi_unidad.index',['carpetas'=>$carpetas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                'nombre' => 'required|max:191',

            ]);

            $carpeta = new Carpeta();
            $carpeta->nombre = $request->nombre;
            $carpeta->save();

            return redirect()->route('mi_unidad.index')
                ->with('mensaje','Se registro la carpeta de la manera correcta')
                ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id) 
    {
        $carpeta = Carpeta::findOrFail($id);
        $subcarpetas = $carpeta->carpetasHijas;
        return view('admin.mi_unidad.show',compact('carpeta','subcarpetas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
        $request->validate([
            'nombre' => 'required|max:191',
        ]);
        $id = $request->id;
        $carpeta = Carpeta::find($id);
        $carpeta->nombre = $request->nombre;
        $carpeta->save();

        return redirect()->route('mi_unidad.index')
            ->with('mensaje','Se cambio el nombre de la carpeta de la manera correcta')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function crear_subcarpeta(Request $request) {

        $request->validate([
            'nombre' => 'required|max:191',
            'carpeta_padre_id' => 'required',

        ]);

        $carpeta = new Carpeta();
        $carpeta->nombre = $request->nombre;
        $carpeta->carpeta_padre_id = $request->carpeta_padre_id;
        $carpeta->save();

        return redirect()->back()
            ->with('mensaje','Se registro la carpeta de la manera correcta')
            ->with('icono','success');

    }

}
