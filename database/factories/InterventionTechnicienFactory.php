<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InterventionTechnicienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date'=> date("Y-m-d"),
            'intervention_id' => rand(1,150),
            'technicien_id' => rand(1,50),
        ];
    }
}
