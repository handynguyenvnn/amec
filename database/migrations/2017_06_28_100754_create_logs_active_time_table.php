<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsActiveTimeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_active_time', function (Blueprint $table) {
            $table->increments('id');               // Active time log ID
            $table->unsignedInteger('user_id');     // User ID
            $table->dateTime('start_time')->nullbale();
            $table->dateTime('end_time')->nullbale();
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
        Schema::dropIfExists('logs_active_time');
    }
}
