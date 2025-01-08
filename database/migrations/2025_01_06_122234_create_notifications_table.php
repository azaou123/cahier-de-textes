<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('ID_Notification');
            $table->unsignedBigInteger('ID_Utilisateur'); // Foreign key column
            $table->text('Message');
            $table->dateTime('Date_Notification');
            $table->string('Statut')->default('non lu');
            $table->timestamps();
            $table->softDeletes(); // Soft delete

            // Define foreign key constraint
            $table->foreign('ID_Utilisateur')
                  ->references('ID_Utilisateur') // Correct referenced column
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
