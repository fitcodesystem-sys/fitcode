<?php

namespace Database\Factories;

use App\Models\Matricula;
use App\Models\Pessoa;
use App\Models\Aula;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Matricula>
 */
class MatriculaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Instancia o Faker em português
        $faker = \Faker\Factory::create('pt_BR');

        // Busca aleatoriamente um aluno (pessoa que não é instrutor)
        $aluno = Pessoa::where('eh_instrutor', false)->inRandomOrder()->first() 
                 ?? Pessoa::factory()->state(['eh_instrutor' => false])->create();

        // Busca aleatoriamente uma aula cadastrada
        $aula = Aula::inRandomOrder()->first() 
                ?? Aula::factory()->create();

        $dataInicio = $faker->dateTimeBetween('-6 months', 'now');
        $dataFim = (clone $dataInicio)->modify('+30 days'); // Matrícula válida por 30 dias

        return [
            'pessoa_id' => $aluno->id,
            'aula_id' => $aula->id,
            'data_matricula' => $dataInicio->format('Y-m-d'),
            'data_inicio' => $dataInicio->format('Y-m-d'),
            'data_fim' => $dataFim->format('Y-m-d'),
            'valor_pago' => $faker->randomFloat(2, 80.00, 250.00),
        ];
    }
}
