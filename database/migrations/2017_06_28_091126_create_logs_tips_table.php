<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_tips', function (Blueprint $table) {
            $table->increments('id');                           // TPS Log ID
            $table->unsignedInteger('tips_id');                 // TIPS ID
            $table->unsignedInteger('lesson_log_id');           // Lesson log ID
            $table->unsignedInteger('small_test_log_id');       // Small test log ID
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
        Schema::dropIfExists('logs_tips');
    }
}
