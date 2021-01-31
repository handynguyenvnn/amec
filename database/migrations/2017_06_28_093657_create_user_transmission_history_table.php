<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTransmissionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_transmission_history', function (Blueprint $table) {
            $table->increments('id');                   // User transmission history ID
            $table->unsignedInteger('chat_tool_id');    // Chat tool ID
            $table->dateTime('sent_date');              // Sent date and time
            $table->text('contents');                   // Contents
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
        Schema::dropIfExists('user_transmission_history');
    }
}
