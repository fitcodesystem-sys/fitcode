<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aulas', function (Blueprint $table) {
            // 1. Adiciona o campo de valor da aula / mensalidade
            if (!Schema::hasColumn('aulas', 'valor')) {
                $table->decimal('valor', 10, 2)->default(0.00)->after('capacidade_maxima');
            }

            // 2. Remove o instructor_id antigo (integer simples) para recriar como chave estrangeira compatível
            if (Schema::hasColumn('aulas', 'instructor_id')) {
                // Se houver alguma constraint antiga, removemos antes
                try {
                    $table->dropForeign(['instructor_id']);
                } catch (\Exception $e) {
                    // Ignora se não existir constraint física
                }
                $table->dropColumn('instructor_id');
            }

            // 3. Recria o instructor_id como chave estrangeira correta apontando para 'pessoas.id'
            $table->foreignId('instructor_id')
                  ->nullable()
                  ->after('valor')
                  ->constrained('pessoas')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('aulas', function (Blueprint $table) {
            // Remove a foreign key e a coluna em caso de rollback
            $table->dropForeign(['instructor_id']);
            $table->dropColumn(['valor', 'instructor_id']);
            
            // Recria o integer antigo caso precise voltar atrás
            $table->integer('instructor_id')->nullable();
        });
    }
};