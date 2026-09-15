<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

// Rota para a tela de login (Apenas exibe o formulário, por isso o método GET)
Route::get('/login', [UsuarioController::class, 'showLoginForm'])
    ->name('usuarios.login'); // Indica a página que será acessada

// Rota para a tela de registro (Apenas exibe o formulário, por isso o método GET)
Route::get('/registro', [UsuarioController::class, 'showRegistroForm'])
    ->name('usuarios.registro'); // Indica a página que será acessada
