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
            $table->string("photo_url");
            $table->date("date_naissance")->unique();
            $table->string("telephone")->unique();
            $table->string("adresse");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profil')->default("client");
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
