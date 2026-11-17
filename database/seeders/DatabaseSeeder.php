<?php

namespace Database\Seeders;

use App\Models\Aula;
use App\Models\Pessoa;
use App\Models\Matricula;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Pessoa::factory()->count(50)->create();
        if (Pessoa::where('eh_instrutor', true)->count() === 0) {
            Pessoa::factory()->count(3)->state(['eh_instrutor' => true])->create();
        }

        Aula::factory()->count(10)->create();

        Matricula::factory()->count(60)->create();
    }
}
