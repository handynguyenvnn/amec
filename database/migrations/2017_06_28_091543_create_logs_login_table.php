<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_login', function (Blueprint $table) {
            $table->increments('id');               // Login Log ID
            $table->unsignedInteger('user_id');     // User ID
            $table->timestamp('login_date');        // Login Date Time (TimeStamp)
            $table->boolean('mobile_platform')->nulable();               // android : 0 / ios : 1
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
        Schema::dropIfExists('logs_login');
    }
}
