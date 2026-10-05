<?php

use App\Http\Controllers\CurriculoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\InscricaoController;
use App\Http\Controllers\VagaController;
use Illuminate\Support\Facades\Route;




// Rota de testes para a página 'home'
Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');
// O middleware auth impede que o usuário acesse a página sem estar logado.

// Rota para a tela de login (Apenas exibe o formulário, por isso o método GET)
Route::get('/login', [UsuarioController::class, 'showLoginForm'])
    ->name('login'); // Indica a rota (função) que será executado

// Rota para a função de login
Route::post('/login', [UsuarioController::class, 'login'])
    ->name('usuarios.login.entrar');

// Rota para a tela de registro (Apenas exibe o formulário, por isso o método GET)
Route::get('/registro', [UsuarioController::class, 'showRegistroForm'])
    ->name('usuarios.registro');

// Rota para a função de cadastro
Route::post('/registro', [UsuarioController::class, 'registro'])
    ->name('usuarios.registro.salvar');

// Rota para a função de logout
Route::post('/logout', [UsuarioController::class, 'logout'])
    ->name('usuarios.logout');

// GRUPO DE CANDIDATOS

// Middleware para as páginas do candidatos
Route::middleware(['auth', 'tipo:1'])->group(function () {

    // CADASTRO DE CURRÍCULOS

    // Rota para o formulário de cadastro do currículo
    Route::get('/curriculo/create', [CurriculoController::class, 'create'])
        ->name('curriculos.create');

    // Rota para função de cadastrar o currículo
    Route::post('/curriculo', [CurriculoController::class, 'store'])
        ->name('curriculos.store');

    // Consulta dos currículos do usuário
    Route::get('/curriculo', [CurriculoController::class, 'show'])
        ->name('curriculos.show');

    // Remoção do currículo
    Route::delete('/curriculo', [CurriculoController::class, 'destroy'])
        ->name('curriculos.destroy');

    // INSCRIÇÕES PARA VAGAS

    // Consultas de vagas disponíveis para inscrição (exclusivo para candidatos)
    Route::get('/vagas-disponiveis', [VagaController::class, 'vagasDisponiveis'])
        ->name('vagas.disponiveis');

    // Detalhes da vaga
    Route::get('/vagas-disponiveis/{vaga}', [VagaController::class, 'detalhes'])
        ->name('vagas.detalhes');

    // Inscrição para vaga
    Route::post('/vagas/{vaga}/candidatar', [InscricaoController::class, 'store'])
        ->name('inscricoes.store');

    // Vagas candidatadas dos candidatos
    Route::get('/minhas-candidaturas', [InscricaoController::class, 'index'])
        ->name('inscricoes.index');

    // Função de cancelamento/desistência da vaga
    Route::patch('/inscricoes/{inscricao}/cancelar', [InscricaoController::class, 'cancelar'])
        ->name('inscricoes.cancelar');
});

// GRUPO DE EMPRESAS

// Middleware para as páginas das empresas
Route::middleware(['auth', 'tipo:2'])->group(function () {

    // Rota completa para o grupo de empresas
    Route::resource('vagas', VagaController::class);

    Route::patch('/vagas/{vaga}/fechar', [VagaController::class, 'fechar'])
        ->name('vagas.fechar');

    // Função para buscar todas as inscrições de uma vaga específica
    Route::get('/vagas/{vaga}/inscricoes', [InscricaoController::class, 'inscricoesPorVaga'])
        ->name('inscricoes.empresa');

    // Funções de aprovar ou rejeitar as candidaturas
    Route::patch('/inscricoes/{inscricao}/aprovar', [InscricaoController::class, 'aprovar'])
        ->name('inscricoes.aprovar');

    Route::patch('/inscricoes/{inscricao}/rejeitar', [InscricaoController::class, 'rejeitar'])
        ->name('inscricoes.rejeitar');
});
