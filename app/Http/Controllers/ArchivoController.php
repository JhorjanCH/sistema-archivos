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
        $estado_archivo = $archivo->estado_archivo;
        if ($estado_archivo=="PRIVADO"){
            Storage::delete($archivo->carpeta_id.'/'.$archivo->nombre);

            Archivo::destroy($id);

        return redirect()->back()
           ->with('mensaje', 'Se elimino archivo de la manera correcta')
           ->with('icono','success');
        }else {
            Storage::delete('public/'.$archivo->carpeta_id.'/'.$archivo->nombre);
            Archivo::destroy($id);

        return redirect()->back()
            ->with('mensaje', 'Se elimino archivo de la manera correcta')
            ->with('icono','success');
            
        }
        
   }
   public function privado_a_publico(Request $request) {
        $id = $request->id;
        $estado_archivo = "PUBLICO";

        $archivo = Archivo::find($id);
        $carpeta_id = $archivo->carpeta_id;
        $nombre = $archivo->nombre;

        $archivo->estado_archivo = $estado_archivo;
        $archivo->save();

        $ruta_archivo_privado = $carpeta_id.'/'.$nombre;
        $ruta_archivo_publico = 'public/'.$carpeta_id.'/'.$nombre;

        Storage::move($ruta_archivo_privado, $ruta_archivo_publico);

        return redirect()->back()
            ->with('mensaje', 'Se cambio el estado del archivo de la manera correcta')
            ->with('icono','success');
   }
   public function publico_a_privado(Request $request) {
        $id = $request->id;
        $estado_archivo = "PRIVADO";

        $archivo = Archivo::find($id);
        $carpeta_id = $archivo->carpeta_id;
        $nombre = $archivo->nombre;

        $archivo->estado_archivo = $estado_archivo;
        $archivo->save();

        $ruta_archivo_privado = $carpeta_id.'/'.$nombre;
        $ruta_archivo_publico = 'public/'.$carpeta_id.'/'.$nombre;

        Storage::move($ruta_archivo_publico, $ruta_archivo_privado);

        return redirect()->back()
            ->with('mensaje', 'Se cambio el estado del archivo de la manera correcta')
            ->with('icono','success');
   }
}
