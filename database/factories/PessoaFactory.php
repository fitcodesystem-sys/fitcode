<?php

namespace Database\Factories;

use App\Models\Pessoa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pessoa>
 */
class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');
        
        $ehInstrutor = $this->faker->boolean(20); // 20% de chance de ser instrutor

        return [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => $this->faker->numerify('###########'),
            'rg' => $this->faker->numerify('#######'),
            'genero' => $this->faker->randomElement(['masculino', 'feminino']),
            'profissao' => substr($this->faker->jobTitle(), 0, 30),
            'nascimento' => $this->faker->date('Y-m-d', '-18 years'),
            'eh_instrutor' => $ehInstrutor,
            'saude' => 'Nenhuma restrição relatada',
            'contato_emergencia' => $this->faker->numerify('119########'),
            'ativo' => true,
        ];
    }
}
