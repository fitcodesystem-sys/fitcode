<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
       Schema::create('aula_user', function (Blueprint $table){
        $table->id();

        $table->foreignId('user_id')
        ->constrained('users')
        ->cascadeOnDelete();

         $table->foreignId('aula_id')
        ->constrained('aulas')
        ->cascadeOnDelete();

        $table->timestamps();

        $table->unique(['user_id', 'aula_id']);
       });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
