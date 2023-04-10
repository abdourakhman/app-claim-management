<?php

namespace Database\Factories;

use App\Models\Intervention;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterventionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Intervention::class;

    public function definition()
    {
        return [
            'lieu' => $this->faker->address,
            'statut' => rand(0,1),
        ];
    }
}
