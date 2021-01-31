<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages_tips', function (Blueprint $table) {
            $table->increments('id');                         // Message ID (auto increment)
            $table->unsignedInteger('tips_id');               // TIPS ID
            $table->unsignedTinyInteger('language_id');       // Language ID
            $table->text('passing_message');                  // Passing message
            $table->text('failed_message');                   // Failed message
            $table->text('correct_message');                  // Correct message
            $table->text('incorrect_message');                // Incorrect message
            $table->string('file_id', 64);              // File ID (message)
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
        Schema::dropIfExists('messages_tips');
    }
}
