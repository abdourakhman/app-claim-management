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
            'CIN' => $this->faker->swiftBicNumber,           
            'user_id' => rand(1,165)
        ];
    }
}
