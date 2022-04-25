<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->numerify('CEP####'),
            'famille' => $this->faker->randomElement(['Particulier', 'GrandCompte']),
            'status' => $this->faker->randomElement(['Actif', 'Inactif']),
            'categorie' => $this->faker->randomElement(['Categorie 1', 'Categorie 2','Categorie 3']),
            'raison_social' => $this->faker->word(),
            'if' => $this->faker->word(),
            'ice' => $this->faker->word(),
            'rc' => $this->faker->word(),
            'patente' => $this->faker->randomDigit(),
            'cin' => $this->faker->word(),
            'agent_commercial' => $this->faker->word(),
            // 'nom_agent_commercial' => $this->faker->name(),
            // 'tel_agent_commercial' => $this->faker->phoneNumber(),
            'mode_paiement' => $this->faker->randomElement(['Cheque', 'Carte Bancaire','Espece']),
            'nom' => $this->faker->name(),
            'fonction' => $this->faker->word(),
            'email' => $this->faker->email(),
            'fix' => $this->faker->phoneNumber(),
            'fax' => $this->faker->phoneNumber(),
            'portable' => $this->faker->phoneNumber(),
            'adresse' => $this->faker->address(),
            'ville' => $this->faker->city(),
            'pays' => $this->faker->country(),
        ];
    }
}
