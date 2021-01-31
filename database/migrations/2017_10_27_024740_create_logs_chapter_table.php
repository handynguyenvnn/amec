<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsChapter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs_chapter', function (Blueprint $table) {
            $table->increments('id');               // Coma Log ID (auto increment)
            $table->string('control_no')->nullable();           // Management/Control number (chapter) => hash value
            $table->unsignedInteger('user_id');     // User ID
            $table->unsignedInteger('chapter_id');
            $table->bigInteger('management_number');
            $table->dateTime('date');           // Coma end date
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
        Schema::dropIfExists('logs_chapter');
    }
}
