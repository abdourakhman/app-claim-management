<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamationTechniciensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamation_techniciens', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('reclamation_id')->onDelete("cascacde")->onUpdate("cascade");
            $table->foreignId('technicien_id')->onDelete("cascacde")->onUpdate("cascade");
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
        Schema::table('reclamation_techniciens', function (Blueprint $table) {
            $table->dropForeign(['reclamation_id','technicien_id']);
        });

        Schema::dropIfExists('reclamation_techniciens');
    }
}
