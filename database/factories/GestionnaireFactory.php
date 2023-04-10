<?php

namespace Database\Factories;

use App\Models\Gestionnaire;
use Illuminate\Database\Eloquent\Factories\Factory;

class GestionnaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Gestionnaire::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'photo_url' => $this->faker->imageUrl(),
            'email' => $this->faker->unique()->safeEmail,
            'sexe' => array_rand(["F","M",1]),
            'date_naissance' => $this->faker->unique()->date($format = 'Y-m-d', $max = '1999-06-09'),
            'telephone' => $this->faker->e164PhoneNumber,
            'adresse' => $this->faker->address,
        ];
    }
}
