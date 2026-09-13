<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    // Função para exibir a view de cadastro de usuário
    public function cadastroView()
    {
        return view('usuario.cadastro');
    }

    // Função de cadastro de usuário
    public function cadastro(Request $request)
    {
        // Validação dos dados recebidos do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'senha' => 'required|string|min:6|confirmed',
        ]);

        // Criação do usuário
        $usuario = Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => Hash::make($request->senha),
        ]);

        // Redirecionamento após o cadastro
        return redirect()
            ->route('usuario.login')
            ->with('success', 'Usuário cadastrado com sucesso.');
    }

    // Função para exibir a view de login de usuário
    public function loginView()
    {
        return view('usuario.login');
    }

    // Função de login de usuário
    public function login(Request $request)
    {
        // Validação dos dados recebidos do formulário
        $request->validate([
            'email' => 'required|string|email',
            'senha' => 'required|string',
        ]);

        // Verificação do usuário no banco de dados
        $usuario = Usuario::where('email', $request->email)->first();

        // Verificação da senha
        if ($usuario && Hash::check($request->senha, $usuario->senha)) {
            // Autenticação bem-sucedida, redirecionar para a página desejada
            return redirect()
                ->route('vagas.index')  // Redirecionar para a página de vagas após o login
                ->with('success', 'Login realizado com sucesso.');
        } else {
            // Autenticação falhou, redirecionar de volta com mensagem de erro
            return redirect()
                ->back()
                ->withErrors(['email' => 'Credenciais inválidas.']);
        }
    }

    // Função de logout de usuário
    public function logout(Request $request){
        // Limpar a sessão do usuário
        $request->session()->flush();

        // Redirecionar para a página de login
        return redirect()
            ->route('usuario.login')
            ->with('success', 'Logout realizado com sucesso.');
    }
}
