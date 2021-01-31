<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmallTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('small_tests', function (Blueprint $table) {
            $table->increments('id');                       // Small test ID
            $table->unsignedInteger('chapter_id')->nullable();          // Chapter ID
            $table->unsignedTinyInteger('num_issues')->nullable();      // Number of issues
            $table->unsignedTinyInteger('pass_score_rate')->nullable(); // Pass score correct answer rate
            $table->boolean('question_format')->nullable();             // Question format
            $table->boolean('option_display_format')->nullable();       // Option display format
            $table->string('control_no')->nullable();                   // Management/control number (small test) => hash value
            $table->string('file_id', 64)->nullable();            // File ID (small test setting)
            $table->string('folder_id', 64)->nullable();// Folder ID (small test)
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
        Schema::dropIfExists('small_tests');
    }
}
