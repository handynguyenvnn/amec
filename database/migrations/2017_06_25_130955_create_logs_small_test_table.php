<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsSmallTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_small_test', function (Blueprint $table) {
            $table->increments('id');                   // Small test log ID
            $table->char('relate_version', 50)->nullable();           // md5(time())
            $table->unsignedInteger('small_test_id')->nullable();         // User ID
            $table->string('control_no');               // Management/Control number (small test) => hash value
            $table->unsignedInteger('user_id');         // User ID
            $table->unsignedTinyInteger('point');       // Point
            $table->boolean('result');                  // Pass / fail (boolean)
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
        Schema::dropIfExists('logs_small_test');
    }
}
