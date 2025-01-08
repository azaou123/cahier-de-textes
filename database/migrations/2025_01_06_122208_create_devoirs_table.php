<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevoirsTable extends Migration
{
    public function up()
    {
        Schema::create('devoirs', function (Blueprint $table) {
            $table->id('ID_Devoir'); // Primary key
            $table->string('Titre_Devoir');
            $table->text('Description_Devoir')->nullable();
            $table->dateTime('Date_Limite');
            $table->unsignedBigInteger('ID_Cours'); // Foreign key column
            $table->timestamps();
            $table->softDeletes(); // Soft delete

            // Define foreign key constraint
            $table->foreign('ID_Cours')
                  ->references('ID_Cours') // Correct referenced column
                  ->on('cours')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('devoirs');
    }
}