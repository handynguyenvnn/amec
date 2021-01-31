<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdministratorTransmissionHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('administrator_transmission_history', function (Blueprint $table) {
            $table->increments('id');                   // Administrator transmission history ID
            $table->unsignedInteger('chat_tool_id');    // Chat tool ID
            $table->dateTime('received_date');          // Received date
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
        Schema::dropIfExists('administrator_transmission_history');
    }
}
