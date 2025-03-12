<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Carpeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CarpetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {   
         $id_user = Auth::user()->id;
         $carpetas = Carpeta::whereNull('carpeta_padre_id')
                             ->where('user_id', $id_user)
                             ->where('borrado', false)
                             ->get();
     
         return view('admin.mi_unidad.index', ['carpetas' => $carpetas]);
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
    $carpeta->user_id = Auth::id(); // Obtén el ID del usuario autenticado
    $carpeta->estado_carpeta = 'PRIVADO';
    $carpeta->borrado = false;
    $carpeta->save();

    return redirect()->route('mi_unidad.index')
        ->with('mensaje', 'Creación exitosa')
        ->with('icono', 'success');
}

    /**
     * Display the specified resource.
     */
    

public function show($id)
{
    $carpeta = Carpeta::findOrFail($id);

    // Verifica si el usuario autenticado es el dueño de la carpeta
    if ($carpeta->user_id !== Auth::id()) {
        abort(403, 'Acceso denegado'); // Error 403 si el usuario no es el propietario
    }

    $subcarpetas = $carpeta->carpetasHijas()->where('borrado', false)->get();
    $archivos = $carpeta->archivos()->where('borrado', false)->get();
         
    return view('admin.mi_unidad.show', compact('carpeta', 'subcarpetas', 'archivos'));
}

     
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
            ->with('mensaje','Cambio exitoso')
            ->with('icono','success');
    }
    public function update_color(Request $request)
    {
        $id = $request->id;
        $carpeta = Carpeta::find($id);
        $carpeta->color = $request->color;
        $carpeta->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carpeta = Carpeta::find($id);

        if ($carpeta) {
            $this->marcarBorradoRecursivo2($carpeta);
            
            return redirect()->back()
                ->with('mensaje', 'Carpetas y subcarpetas eliminadas')
                ->with('icono', 'success');
        }

        return redirect()->back()
            ->with('mensaje', 'No se ha encontrado la subcarpeta')
            ->with('icono', 'error');
    }

    private function marcarBorradoRecursivo2($carpeta)
    {
        $carpeta->borrado = true;
        $carpeta->save();

        $subcarpetas = Carpeta::where('carpeta_padre_id', $carpeta->id)->get();
        foreach ($subcarpetas as $subcarpeta) {
            $this->marcarBorradoRecursivo($subcarpeta);
        }

        $archivos = Archivo::where('carpeta_id', $carpeta->id)->get();
        foreach ($archivos as $archivo) {
            $archivo->borrado = true;
            $archivo->save();
        }
    }
    public function crear_subcarpeta(Request $request) {

        $request->validate([
            'nombre' => 'required|max:191',
            'carpeta_padre_id' => 'required',

        ]);

        $carpeta = new Carpeta();
        $carpeta->nombre = $request->nombre;
        $carpeta->user_id = $request->user_id;
        $carpeta->carpeta_padre_id = $request->carpeta_padre_id;
        $carpeta->estado_carpeta = 'PRIVADO';
        $carpeta->borrado = false;
        $carpeta->save();

        return redirect()->back()
            ->with('mensaje','Creación exitosa')
            ->with('icono','success');

    }
    public function update_subcarpeta(Request $request) {

        $request->validate([
            'nombre' => 'required|max:191',

        ]);

        $id = $request->id;
        $carpeta = Carpeta::find($id);
        $carpeta->nombre = $request->nombre;
        $carpeta->save();

        return redirect()->back()
            ->with('mensaje','Datos actualizado')
            ->with('icono','success');

    }
    public function update_subcarpeta_color(Request $request) {
        $id = $request->id;
        $carpeta = Carpeta::find($id);
        $carpeta->color = $request->color;
        $carpeta->save();

        return redirect()->back();
    }

    public function destroy_subcarpeta($id)
{
        $carpeta = Carpeta::find($id);

        if ($carpeta) {
            $this->marcarBorradoRecursivo($carpeta);
            
            return redirect()->back()
                ->with('mensaje', 'Carpetas y subcarpetas eliminadas')
                ->with('icono', 'success');
        }

        return redirect()->back()
            ->with('mensaje', 'No se ha encontrado la subcarpeta')
            ->with('icono', 'error');
    }

    private function marcarBorradoRecursivo($carpeta)
    {
        $carpeta->borrado = true;
        $carpeta->save();

        $subcarpetas = Carpeta::where('carpeta_padre_id', $carpeta->id)->get();
        foreach ($subcarpetas as $subcarpeta) {
            $this->marcarBorradoRecursivo($subcarpeta);
        }

        $archivos = Archivo::where('carpeta_id', $carpeta->id)->get();
        foreach ($archivos as $archivo) {
            $archivo->borrado = true;
            $archivo->save();
        }
    }


public function restaurarCarpeta($id)
{
    $carpeta = Carpeta::find($id);

    if ($carpeta) {
        $this->restaurarRecursivo($carpeta);

        return redirect()->back()
            ->with('mensaje', 'Carpeta y su contenido restaurados con éxito')
            ->with('icono', 'success');
    }

    return redirect()->back()
        ->with('mensaje', 'Carpeta no encontrada')
        ->with('icono', 'error');
}

private function restaurarRecursivo($carpeta)
{
    $carpeta->borrado = false;
    $carpeta->save();

    $subcarpetas = Carpeta::where('carpeta_padre_id', $carpeta->id)->get();
    foreach ($subcarpetas as $subcarpeta) {
        $this->restaurarRecursivo($subcarpeta);
    }

    $archivos = Archivo::where('carpeta_id', $carpeta->id)->get();
    foreach ($archivos as $archivo) {
        $archivo->borrado = false;
        $archivo->save();
    }
}
public function restaurarSubcarpeta($id)
{
    $carpeta = Carpeta::find($id);

    if ($carpeta) {
        $this->restaurarRecursivoSubcarpeta($carpeta);

        return redirect()->back()
            ->with('mensaje', 'Subcarpeta y su contenido restaurados con éxito')
            ->with('icono', 'success');
    }

    return redirect()->back()
        ->with('mensaje', 'Subcarpeta no encontrada')
        ->with('icono', 'error');
}

private function restaurarRecursivoSubcarpeta($carpeta)
{
    $carpeta->borrado = false;
    $carpeta->save();

    $subcarpetas = Carpeta::where('carpeta_padre_id', $carpeta->id)->get();
    foreach ($subcarpetas as $subcarpeta) {
        $this->restaurarRecursivoSubcarpeta($subcarpeta);
    }

    $archivos = Archivo::where('carpeta_id', $carpeta->id)->get();
    foreach ($archivos as $archivo) {
        $archivo->borrado = false;
        $archivo->save();
    }
}
}



    
