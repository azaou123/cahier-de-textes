<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRendusDevoirTable extends Migration
{
    public function up()
    {
        Schema::create('rendu_devoirs', function (Blueprint $table) {
            $table->id('ID_Rendu');
            $table->unsignedBigInteger('ID_Devoir'); // Foreign key column
            $table->unsignedBigInteger('ID_Utilisateur'); // Foreign key column
            $table->string('Fichier_Rendu');
            $table->dateTime('Date_Rendu');
            $table->float('Note')->nullable();
            $table->text('Commentaire')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Soft delete

            // Define foreign key constraints
            $table->foreign('ID_Devoir')
                  ->references('ID_Devoir') // Correct referenced column
                  ->on('devoirs')
                  ->onDelete('cascade');

            $table->foreign('ID_Utilisateur')
                  ->references('ID_Utilisateur') // Correct referenced column
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rendus_devoir');
    }
}