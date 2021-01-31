<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTrophySetting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_trophy_setting', function (Blueprint $table) {
            $table->increments('id');                       // Message ID (auto increment)
            $table->unsignedInteger('trophy_setting_id');   // Trophy setting ID
            $table->unsignedTinyInteger('language_id');     // Language ID
            $table->text('message');                        // Message
            $table->string('file_id', 64);            // File ID (message)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages_trophy_setting');
    }
}
