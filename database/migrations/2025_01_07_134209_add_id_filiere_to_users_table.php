<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdFiliereToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Ajouter la colonne ID_Filiere
            $table->unsignedBigInteger('ID_Filiere')->nullable()->after('Role');

            // Définir la clé étrangère
            $table->foreign('ID_Filiere')
                  ->references('ID_Filiere')
                  ->on('filieres')
                  ->onDelete('set null'); // Si la filière est supprimée, ID_Filiere devient NULL
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Supprimer la clé étrangère
            $table->dropForeign(['ID_Filiere']);

            // Supprimer la colonne ID_Filiere
            $table->dropColumn('ID_Filiere');
        });
    }
}