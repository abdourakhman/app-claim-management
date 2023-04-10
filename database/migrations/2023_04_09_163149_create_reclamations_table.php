<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();
            $table->string("designation");
            $table->text("description")->nullable();
            $table->date("date");
            $table->foreignId("client_id")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("gestionnaire_id")->onDelete("cascade")->onUpdate("cascade");
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
        Schema::table('reclamations', function (Blueprint $table) {
            $table->dropForeign(['client_id','gestionnaire_id']);
        });
        Schema::dropIfExists('reclamations');
    }
}
