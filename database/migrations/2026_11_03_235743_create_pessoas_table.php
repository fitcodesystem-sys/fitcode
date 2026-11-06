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
      Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', length: 255);
            $table->string('cpf', length: 11);
            $table->string('rg', length: 9);
            $table->enum('genero', ['masculino', 'femenino', 'outro']);
            $table->string('profissao', length: 32);
            $table->date('nascimento');
            $table->string('email', length: 128);
            $table->string('contato_emergencia', length: 128);
            $table->string('responsavel_nome', length: 128);
            $table->string('responsavel_parentesco', length: 128);
            $table->string('responsavel_contato', length: 128);
            $table->string('responsavel_documento', length: 11);
            $table->boolean('ativo')->default(true);
            $table->text('saude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('pessoas');
    }
};
