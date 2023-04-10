<?php

namespace Database\Seeders;

use App\Models\Fiche;
use App\Models\Client;
use App\Models\Technicien;
use App\Models\Reclamation;
use App\Models\Gestionnaire;
use App\Models\Intervention;
use App\Models\TechnicienType;
use Illuminate\Database\Seeder;
use App\Models\ReclamationTechnicien;
use App\Models\InterventionTechnicien;
use Database\Seeders\TypeTechnicienSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeTechnicienSeeder::class);
        Client::factory(100)->create();
        Gestionnaire::factory(15)->create();
        Technicien::factory(50)->create();
        Reclamation::factory(150)->create();
        Fiche::factory(100)->create();
        Intervention::factory(150)->create();
        TechnicienType::factory(50)->create();
        ReclamationTechnicien::factory(150)->create();
        InterventionTechnicien::factory(150)->create();


        // \App\Models\User::factory(10)->create();
    }
}
