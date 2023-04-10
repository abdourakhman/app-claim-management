<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiches', function (Blueprint $table) {
            $table->id();
            $table->string("titre");
            $table->text("detail");
            $table->text("suggestion");
            $table->foreignId('technicien_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('fiches', function (Blueprint $table) {
            $table->dropForeign(['technicien_id']);
        });
        Schema::dropIfExists('fiches');
    }
}
