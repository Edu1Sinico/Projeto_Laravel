<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('curriculos', function (Blueprint $table) {
            $table->unique('idUsuario', 'curriculo_idUsuario_unique');
        });

        Schema::table('inscricaos', function (Blueprint $table) {
            $table->unique(
                ['idCandidato', 'idVaga'],
                'inscricao_candidato_vaga_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('curriculos', function (Blueprint $table) {
            $table->dropUnique('curriculo_idUsuario_unique');
        });

        Schema::table('inscricaos', function (Blueprint $table) {
            $table->dropUnique('inscricao_candidato_vaga_unique');
        });
    }
};
