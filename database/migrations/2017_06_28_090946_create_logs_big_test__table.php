<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsBigTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_big_test', function (Blueprint $table) {
            $table->increments('id');                   // Big test log ID
            $table->char('relate_version', 50)->nullable();           // md5(time())
            $table->unsignedInteger('big_test_id')->nullable();         // User ID
            $table->string('control_no')->nullable();               // Management/Control number (big test) => hash value
            $table->unsignedInteger('user_id');         // User ID
            $table->unsignedTinyInteger('point');       // Point (score)
            $table->boolean('result');                  // Pass:1 / fail:0 boolean
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
        Schema::dropIfExists('logs_big_test');
    }
}
