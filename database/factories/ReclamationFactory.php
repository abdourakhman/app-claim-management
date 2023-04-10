<?php

namespace Database\Factories;

use App\Models\Reclamation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReclamationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Reclamation::class;

    public function definition()
    {
        return [
            'designation' => $this->faker->catchPhrase,
            'description' =>$this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'date' => date('Y-m-d'),
            'client_id' =>rand(1,100),
            'gestionnaire_id' =>rand(1,15),
        ];
    }
}

