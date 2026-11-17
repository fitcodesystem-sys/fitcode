<?php

namespace Database\Factories;

use App\Models\Aula;
use App\Models\Pessoa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Aula>
 */
class AulaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');
        
        // Busca aleatoriamente uma pessoa que seja instrutora
        $instrutor = Pessoa::where('eh_instrutor', true)->inRandomOrder()->first();

        return [
            'nome' => $this->faker->randomElement(['Musculação Avançada', 'Pilates Solo', 'Spinning Intense', 'Zumba Fit', 'CrossFit Core', 'Muay Thai']),
            'descricao' => $this->faker->sentence(),
            'horario' => $this->faker->time('H:i'),
            'capacidade_maxima' => $this->faker->numberBetween(10, 35),
            'instrutor_id' => $instrutor ? $instrutor->id : Pessoa::factory()->state(['eh_instrutor' => true]),
        ];
    }
}
