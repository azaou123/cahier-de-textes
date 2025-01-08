<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id('ID_Cours');
            $table->string('Nom_Cours');
            $table->text('Description_Cours')->nullable();
            $table->unsignedBigInteger('ID_Filiere'); // Foreign key column
            $table->unsignedBigInteger('ID_Professeur'); // Foreign key column
            $table->timestamps();
            $table->softDeletes(); // Soft delete

            // Define foreign key constraints
            $table->foreign('ID_Filiere')
                  ->references('ID_Filiere') // Correct referenced column
                  ->on('filieres')
                  ->onDelete('cascade');

            $table->foreign('ID_Professeur')
                  ->references('ID_Utilisateur') // Correct referenced column
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cours');
    }
}
