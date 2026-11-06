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
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->constrained('pessoas')->onDelete('cascade');
            $table->foreignID('aula_id')->constrained('aulas')->onDelete('cascade');
            $table->date('data_matricula');
            $table->decimal('valor_pago', 10, 2)->default(0.00);
            $table->date('data_pagamento')->nullable();
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->string('observacoes', 255)->nullable();
            $table->enum('status', ['ativa', 'vencida', 'cancelada', 'pendente'])->default('ativa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matriculas');
    }
};
