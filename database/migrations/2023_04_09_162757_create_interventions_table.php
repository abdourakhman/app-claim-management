<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->string("libelle");
            $table->string('statut')->default("en attente"); //(re)affectée - (non)résolue
            $table->foreignId("reclamation_id")->nullable()->onDelete("cascade")->onUpdate("cascade");
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('interventions', function (Blueprint $table) {
            $table->dropForeign(['reclamation_id']);
        });
        Schema::dropIfExists('interventions');
    }
}
