<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
   public function upload(Request $request) {
        $id = $request->id;
        $file = $request->file('file');
        $fileName = time().'-'.$file->getClientOriginalName();
        //$request->file('file')->storeAs($id,$fileName,'public'); //Cargar de forma pública
        $request->file('file')->storeAs($id,$fileName); //Cargar de forma privada
        //$file->move(public_path($id),$fileName);

        $archivo = new Archivo();
        $archivo->carpeta_id = $request->id;
        $archivo->nombre = $fileName;
        $archivo->estado_archivo = 'PRIVADO';
        $archivo->save();

        return redirect()->back()
            ->with('mensaje', 'Se cargo el archivo de la manera correcta')
            ->with('icono','success');
   }
   public function eliminar_archivo(Request $request) {
        $id = $request->id;
        $archivo = Archivo::find($id);
        Storage::delete('/public'.$archivo->carpeta_id.'/'.$archivo->id);
        Archivo::destroy($id);

        return redirect()->back()
            ->with('mensaje', 'Se elimino archivo de la manera correcta')
            ->with('icono','success');
   }
}
