<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursEtudiantTable extends Migration
{
    public function up()
    {
        Schema::create('cours_etudiant', function (Blueprint $table) {
            // Colonnes
            $table->unsignedBigInteger('ID_Cours');
            $table->unsignedBigInteger('ID_Utilisateur');
            $table->timestamps();

            // Clés étrangères
            $table->foreign('ID_Cours')
                  ->references('ID_Cours')
                  ->on('cours')
                  ->onDelete('cascade');

            $table->foreign('ID_Utilisateur')
                  ->references('ID_Utilisateur') // Référence la colonne ID_Utilisateur dans users
                  ->on('users')
                  ->onDelete('cascade');

            // Clé primaire composite
            $table->primary(['ID_Cours', 'ID_Utilisateur']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('cours_etudiant');
    }
}