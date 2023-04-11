<?php

namespace Database\Factories;

use App\Models\Technicien;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechnicienFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Technicien::class;

    public function definition()
    {
        return [
            'disponibilite' => rand(0,1),
            'user_id' => rand(1,165)
        ];
    }
}
