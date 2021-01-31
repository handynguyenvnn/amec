<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmallTestQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('small_test_questions', function (Blueprint $table) {
            $table->increments('id');                       // Small test question ID (auto increment)
            $table->unsignedInteger('small_test_id')->nullable();       // Small Test ID
            $table->string('title', 64)->nullable();              // Title
            $table->unsignedSmallInteger('question_no', 5)->nullable();
            $table->boolean('question_format')->nullable();             // Question/Problem format
            $table->unsignedTinyInteger('score')->nullable();           // Score
            $table->string('file_id', 64)->nullable();            // File ID (Small test question setting)
            $table->string('folder_id', 64)->nullable();          // Folder ID (Small test question)
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
        Schema::dropIfExists('small_test_questions');
    }
}
