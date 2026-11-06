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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->constrained('pessoas')->onDelete('cascade');
            $table->enum('tipo', ['residencial', 'comercial', 'cobrança', 'outro']);
            $table->string('cep', length: 8);
            $table->string('logradouro', length: 255);
            $table->string('numero', length: 10);
            $table->string('bairro', length: 30);
            $table->string('cidade', length: 50);
            $table->string('estado', length: 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
