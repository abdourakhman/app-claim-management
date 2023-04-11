<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string("nom");
            $table->string("prenom");
            $table->char("sexe");
            $table->string("photo_url")->unique()->default("https://www.google.com/url?sa=i&url=https%3A%2F%2Ffr.freepik.com%2Fphotos-vecteurs-libre%2Flogo-profil&psig=AOvVaw2pzWZ-OMK5TFIY2ORxvIEy&ust=1681173173580000&source=images&cd=vfe&ved=0CBEQjRxqFwoTCPi2-6OInv4CFQAAAAAdAAAAABAJ");
            $table->date("date_naissance")->unique();
            $table->string("telephone")->unique();
            $table->string("adresse")->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profil');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
