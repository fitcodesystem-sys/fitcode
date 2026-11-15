<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->string('responsavel_nome', 128)->nullable()->change();
            $table->string('responsavel_parentesco', 128)->nullable()->change();
            $table->string('responsavel_contato', 128)->nullable()->change();
            $table->string('responsavel_documento', 11)->nullable()->change();
        });
    }

    
    public function down(): void
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->string('responsavel_nome', 128)->nullable(false)->change();
            $table->string('responsavel_parentesco', 128)->nullable(false)->change();
            $table->string('responsavel_contato', 128)->nullable(false)->change();
            $table->string('responsavel_documento', 11)->nullable(false)->change();
        });
    }
};