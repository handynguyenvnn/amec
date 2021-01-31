<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesSmallTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Message (Quiz)
        Schema::create('messages_small_test', function (Blueprint $table) {
            $table->increments('id');                         // Message ID (auto increment)
            $table->unsignedInteger('small_test_id')->nullable();         // Small Test ID
            $table->unsignedTinyInteger('language_id')->nullable();       // Language ID
            $table->text('passing_message')->nullable();                  // Passing message
            $table->text('failed_message')->nullable();                   // Failed message
            $table->text('correct_message')->nullable();                  // Correct message
            $table->text('incorrect_message')->nullable();                // Incorrect message
            $table->string('file_id', 64)->nullable();              // File ID (message)
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
        Schema::dropIfExists('messages_small_test');
    }
}
