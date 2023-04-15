<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $profils=array('client','gestionnaire','technicien');
        $sexe=array('H','F');
        return [
            'email' => $this->faker->unique()->email,
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'sexe' => $sexe[rand(0,1)],
            'photo_url' => $this->faker->unique()->imageUrl(),
            'date_naissance' => $this->faker->unique()->date($format='Y-m-d', $max='1999-01-01'),
            'telephone' => $this->faker->unique()->e164PhoneNumber,
            'adresse' => $this->faker->unique()->address,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'profil' => $profils[rand(0,2)],
            'remember_token' => Str::random(10),
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
