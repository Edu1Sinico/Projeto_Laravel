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
        Schema::table('inscricaos', function (Blueprint $table) {
            $table->dropForeign(['idVaga']);

            $table->foreign('idVaga')
                ->references('id')
                ->on('vagas')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscricaos', function (Blueprint $table) {
            $table->dropForeign(['idVaga']);

            $table->foreign('idVaga')
                ->references('id')
                ->on('vagas');
        });
    }
};
