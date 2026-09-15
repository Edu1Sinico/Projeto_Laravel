<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('usuarios.login');
    }

    // Processa o login do usuário
    public function login(Request $request) {}

    // Exibe o formulário de registro
    public function showRegistroForm()
    {
        return view('usuarios.registro');
    }

    // Processo o registro do usuário
    public function registro(Request $request) {}

    // Processa o logout do usuário
    public function logout(Request $request) {
        
    }
}
