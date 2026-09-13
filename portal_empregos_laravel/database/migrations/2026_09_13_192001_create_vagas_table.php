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
        Schema::create('vagas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idEmpresa')->constrained('usuarios');
            $table->foreignId('idStatus')->constrained('status_vaga');
            $table->string('titulo');
            $table->text('descricao');
            $table->string('localizacao');
            $table->decimal('salario', 8, 2);
            $table->timestamp('dataFechamento')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vagas');
    }
};
