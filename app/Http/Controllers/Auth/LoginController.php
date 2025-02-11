<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Asumiendo que la columna 'name' en tu base de datos contiene el rol
        if ($user->name === 'admin') {
            return redirect('/')
            ->with('mensaje','BIENVENIDOS AL SISTEMA')
            ->with('icono','success');
        } else {
            return redirect('/admin/mi_unidad')
            ->with('mensaje','BIENVENIDOS AL SISTEMA')
            ->with('icono','success');
        }
    }
}


