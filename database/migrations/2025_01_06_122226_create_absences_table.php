<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id('ID_Absence');
            $table->unsignedBigInteger('ID_Utilisateur'); // Foreign key column
            $table->unsignedBigInteger('ID_Seance'); // Foreign key column
            $table->text('Justificatif')->nullable();
            $table->string('Statut')->default('non justifiée');
            $table->timestamps();
            $table->softDeletes(); // Soft delete

            // Define foreign key constraints
            $table->foreign('ID_Utilisateur')
                  ->references('ID_Utilisateur') // Correct referenced column
                  ->on('users')
                  ->onDelete('cascade');

            $table->foreign('ID_Seance')
                  ->references('ID_Seance') // Correct referenced column
                  ->on('seances')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('absences');
    }
}
