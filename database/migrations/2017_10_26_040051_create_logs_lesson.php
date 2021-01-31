<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsLesson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_lesson', function (Blueprint $table) {
            $table->increments('id');                   // logs lesson log ID
            $table->char('relate_version', 50)->nullable();           // md5(time())
            $table->unsignedInteger('coma_id')->nullable();         // Coma ID
            $table->string('control_no');           // Management/Control number (chapter) => hash value
            $table->unsignedInteger('user_id');     // User ID
            $table->dateTime('end_date');           // Coma end date
            $table->boolean('completion_flg');      // Coma completion flag
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
        Schema::dropIfExists('logs_lesson');
    }
}
