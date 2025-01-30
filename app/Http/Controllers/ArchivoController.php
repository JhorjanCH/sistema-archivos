<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use Illuminate\Http\Request;

class ArchivoController extends Controller
{
   public function upload(Request $request) {
        $id = $request->id;
        $file = $request->file('file');
        $fileName = time().'-'.$file->getClientOriginalName();
        $request->file('file')->storeAs($id,$fileName,'public'); //Cargar de forma pública
        //$request->file('file')->storeAs($id,$fileName); //Cargar de forma privada
        //$file->move(public_path($id),$fileName);

        $archivo = new Archivo();
        $archivo->carpeta_id = $request->id;
        $archivo->nombre = $fileName;
        $archivo->save();

        return redirect()->back()
            ->with('mensaje', 'Se cargo el archivo de la manera correcta')
            ->with('icono','success');
   }
}
