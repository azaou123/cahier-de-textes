<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSallesTable extends Migration
{
    public function up()
    {
        Schema::create('salles', function (Blueprint $table) {
            $table->id('ID_Salle'); // Primary key
            $table->string('Nom_Salle');
            $table->integer('Capacite');
            $table->string('Localisation');
            $table->timestamps();
            $table->softDeletes(); // Soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('salles');
    }
}
