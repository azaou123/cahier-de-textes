<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilieresTable extends Migration
{
    public function up()
    {
        Schema::create('filieres', function (Blueprint $table) {
            $table->id('ID_Filiere');
            $table->string('Nom_Filiere');
            $table->text('Description')->nullable();
            $table->unsignedBigInteger('Responsable_Filiere'); // Foreign key column
            $table->timestamps();
            $table->softDeletes(); // Soft delete

            // Define the foreign key constraint
            $table->foreign('Responsable_Filiere')
                  ->references('ID_Utilisateur') // Correct referenced column
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('filieres');
    }
}
