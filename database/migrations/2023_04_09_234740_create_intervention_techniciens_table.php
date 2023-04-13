<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterventionTechniciensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intervention_techniciens', function (Blueprint $table){ 
            $table->date("date");
            $table->foreignId('technicien_id')->onDelete("cascacde")->onUpdate("cascade");
            $table->foreignId('intervention_id')->onDelete("cascacde")->onUpdate("cascade");
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
        Schema::table('intervention_techniciens', function (Blueprint $table) {
            $table->dropForeign(['technicien_id','intervention_id']);
        });
        Schema::dropIfExists('intervention_techniciens');
    }
}
