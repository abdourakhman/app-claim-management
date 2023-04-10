<?php

namespace Database\Factories;

use App\Models\Fiche;
use Illuminate\Database\Eloquent\Factories\Factory;

class FicheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Fiche::class;

    public function definition()
    {
        return [
            'titre' => $this->faker->title,
            'detail' => $this->faker->text,
            'suggestion' =>$this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            'technicien_id' =>rand(1,50),
        ];
    }
}