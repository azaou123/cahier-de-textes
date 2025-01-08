<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeancesTable extends Migration
{
    public function up()
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->id('ID_Seance');
            $table->dateTime('Date_Seance');
            $table->time('Heure_Debut');
            $table->time('Heure_Fin');
            $table->unsignedBigInteger('ID_Cours'); // Foreign key column
            $table->unsignedBigInteger('ID_Salle'); // Foreign key column
            $table->timestamps();
            $table->softDeletes(); // Soft delete

            // Define foreign key constraints
            $table->foreign('ID_Cours')
                  ->references('ID_Cours') // Correct referenced column
                  ->on('cours')
                  ->onDelete('cascade');

            $table->foreign('ID_Salle')
                  ->references('ID_Salle') // Correct referenced column
                  ->on('salles')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('seances');
    }
}
