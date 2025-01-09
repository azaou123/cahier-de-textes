<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('seances', function (Blueprint $table) {
            $table->text('description')->nullable()->after('ID_Salle'); // Ajoutez la colonne
        });
    }

    public function down()
    {
        Schema::table('seances', function (Blueprint $table) {
            $table->dropColumn('description'); // Supprimez la colonne en cas de rollback
        });
    }
};
