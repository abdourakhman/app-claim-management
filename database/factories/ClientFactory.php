<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array
     */
    protected $model = Client::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'photo_url' => $this->faker->imageUrl(),
            'email' => $this->faker->unique()->safeEmail,
            'date_naissance' => $this->faker->unique()->date($format = 'Y-m-d', $max = '1999-06-09'),
            'sexe' => array_rand(["F","M",1]),
            'telephone' => $this->faker->e164PhoneNumber,
            'adresse' => $this->faker->address,
            'identifiant_national' => $this->faker->swiftBicNumber,           
        ];
    }
}
