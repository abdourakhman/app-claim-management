<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReclamationTechnicienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reclamation_id' => rand(1,150),
            'technicien_id' => rand(1,50),
        ];
    }
}
