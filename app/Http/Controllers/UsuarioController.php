<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carpeta; 
use App\Models\Archivo;
use Spatie\Permission\Models\Role; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::where('borrado', false)->get();

    foreach ($usuarios as $usuario) {
        $usuario->carpetas = Carpeta::where('user_id', $usuario->id)->get();
        foreach ($usuario->carpetas as $carpeta) {
            $carpeta->archivos = Archivo::where('carpeta_id', $carpeta->id)->get();
        }
    }

    return view('admin.usuarios.index', ['usuarios' => $usuarios]);
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'cedula' => 'required|unique:users',
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $usuario = new User();
        $usuario->cedula = $request->cedula;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->rol = "usuario";
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->borrado = false;
        $usuario->save();

        //$usuario->assignRole('usuario');

        return redirect()->route('usuarios.index')
            ->with('mensaje','Registro exitoso')
            ->with('icono','success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view ('admin.usuarios.show',['usuario'=>$usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $usuario = User::find($id);
    $roles = Role::whereIn('name', ['admin', 'usuario'])->get();
    return view('admin.usuarios.edit', ['usuario' => $usuario, 'roles' => $roles]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|max:100',
        // otras reglas de validación aquí
    ]);

    $usuario = User::find($id);
    $usuario->cedula = $request->cedula;
    $usuario->nombre = $request->nombre;
    $usuario->apellido = $request->apellido;
    $usuario->rol = $request->rol;

    // Verificar si se ha proporcionado una nueva contraseña
    if ($request->filled('password')) {
        $usuario->password = Hash::make($request->password);
    }

    $usuario->save();

    return redirect()->route('usuarios.index')
        ->with('mensaje', 'Datos actualizados')
        ->with('icono', 'success');
}




    public function borrado_usuario($id)
{
    $usuario = User::find($id);
    
    if ($usuario) {
        $usuario->borrado = true;
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('mensaje', 'Usuario eliminado')
            ->with('icono', 'success');
    }

    return redirect()->route('usuarios.index')
        ->with('mensaje', 'Usuario no encontrado')
        ->with('icono', 'error');
}

    /**
     * Remove the specified resource from storage.
     */

     public function destroy($id)
     {
         $usuario = User::findOrFail($id);
         if ($usuario->rol == 'admin') {
             return redirect()->route('usuarios.index')
                 ->with('mensaje', 'No se puede eliminar el Administrador')
                 ->with('icono', 'error');
         } else {
             //User::destroy($id);
             $usuario->borrado = true;
             $usuario->save();
             return redirect()->route('usuarios.index')
                 ->with('mensaje', 'Usuario eliminado')
                 ->with('icono', 'success');
         }
         
     }
     

    public function registro() {
        return view('auth.registro');
    }

    public function registro_create(Request $request)
    
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'cedula' => 'required|unique:users',
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $usuario = new User();
        $usuario->cedula = $request->cedula;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->rol = "usuario";
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->borrado = false;
        $usuario->save();

        Auth::login($usuario);

        return redirect()->route('mi_unidad.index')
            ->with('mensaje','BIENVENIDOS AL SISTEMA')
            ->with('icono','success');

    }
}
