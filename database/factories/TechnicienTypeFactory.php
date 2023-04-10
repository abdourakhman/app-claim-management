<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TechnicienTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type_id' => rand(1,2),
            'technicien_id' => rand(1,50),
        ];
    }
}
