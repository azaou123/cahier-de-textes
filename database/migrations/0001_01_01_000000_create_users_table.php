<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('ID_Utilisateur');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('Role', ['professeur', 'etudiant', 'admin'])->default('etudiant');
            $table->timestamp('Date_inscription')->useCurrent();
            $table->timestamps();
            $table->softDeletes(); // Soft delete

            
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
        });
    }
}
