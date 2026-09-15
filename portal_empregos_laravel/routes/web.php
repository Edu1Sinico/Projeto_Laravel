<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

// Rota de testes para a página 'home'
Route::get('/', function () {
    return view('home');
})->name('home');

// Rota para a tela de login (Apenas exibe o formulário, por isso o método GET)
Route::get('/login', [UsuarioController::class, 'showLoginForm'])
    ->name('usuarios.login'); // Indica a página que será acessada

// Rota para a função de login
Route::post('/login', [UsuarioController::class, 'login'])
    ->name('usuarios.login.entrar'); // Indica a rota (função) que será executado

// Rota para a tela de registro (Apenas exibe o formulário, por isso o método GET)
Route::get('/registro', [UsuarioController::class, 'showRegistroForm'])
    ->name('usuarios.registro'); // Indica a página que será acessada

// Rota para a função de cadastro
Route::post('/registro', [UsuarioController::class, 'registro'])
    ->name('usuarios.registro.salvar'); // Indica a rota (função) que será executado

// Rota para a função de logout
Route::post('/logout', [UsuarioController::class, 'logout'])
    ->name('usuarios.logout'); // Indica a rota (função) que será executado
