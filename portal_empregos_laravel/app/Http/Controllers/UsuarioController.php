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
    public function login(Request $request)
    {
        // Validando os dados do usuário recebidos
        $dados = $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        // filtra pelo primeiro email de usuário que ele encontrar na tabela
        $usuario = Usuario::where('email', $dados['email'])->first();

        // Realiza a checagem das informações (Se o usuário não foi encontrado OU se a senha digitada não bate com a senha do banco)
        if (!$usuario || !Hash::check($dados['senha'], $usuario->senha)) {
            return back()
                ->withErros([
                    'email' => 'E-mail ou senha inválidos.',
                ])
                ->onlyInput('email');
        }

        // Realiza a autenticação do usuário
        Auth::login($usuario);

        // Renova o identificador da sessão por segurança
        $request->session()->regenerate();

        // Redireciona para a página inicial
        return redirect()->route('home')->with('success', 'Usuário logado com sucesso.');
    }

    // Exibe o formulário de registro
    public function showRegistroForm()
    {
        return view('usuarios.registro');
    }

    // Processo o registro do usuário
    public function registro(Request $request)
    {
        // Validando os dados do usuário recebidos
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios,email',
            'senha' => 'required|string|min:6|confirmed',
            'id_tipo_usuario' => 'required|exists:tipo_usuario,id',
        ]);

        // Criação do usuário com a senha protegida por hash
        Usuario::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'senha' => Hash::make($dados['senha']),
            'idTipoUsuario' => $dados['id_tipo_usuario'],
        ]);

        // Redirecionando para a tela de login
        return redirect()
            ->route('usuarios.login')
            ->with('success', 'Usuário cadastrado com sucesso.');
    }

    // Processa o logout do usuário
    public function logout(Request $request)
    {
        // Encerra a autenticação do usuário
        Auth::logout();

        $request->session()->invalidate(); // Invalida a sessão
        $request->session()->regenerateToken(); // gera um novo token CSRF por segurança.

        return redirect()
            ->route('usuarios.login')
            ->with('sucess', 'Logout realizado com sucesso.');
    }
}
