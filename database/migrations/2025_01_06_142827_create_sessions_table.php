<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Session ID
            $table->foreignId('user_id')->nullable()->index(); // User ID (nullable for guests)
            $table->string('ip_address', 45)->nullable(); // IP address of the user
            $table->text('user_agent')->nullable(); // User agent (browser information)
            $table->text('payload'); // Session data
            $table->integer('last_activity')->index(); // Timestamp of last activity
        });
    }

    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
