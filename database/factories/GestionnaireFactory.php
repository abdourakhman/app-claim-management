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
            'user_id' => rand(1,165)
        ];
    }
}
