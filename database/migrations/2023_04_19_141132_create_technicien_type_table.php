<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnicienTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technicien_type', function (Blueprint $table) {
            $table->timestamps();
            $table->foreignId('technicien_id')->onDelete("cascacde")->onUpdate("cascade");
            $table->foreignId('type_id')->onDelete("cascacde")->onUpdate("cascade");            
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
        Schema::table('technicien_type', function (Blueprint $table) {
            $table->dropForeign(['type_id','technicien_id']);
        });
        
        Schema::dropIfExists('technicien_type');
    }
}
