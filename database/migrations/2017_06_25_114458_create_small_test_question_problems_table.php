<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmallTestQuestionProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('small_test_question_problems', function (Blueprint $table) {
            $table->increments('id');                               // Problem ID (auto increment)
            $table->unsignedInteger('small_test_question_id')->nullable();      // Small test question ID
            $table->text('problem_statement')->nullable();                      // Problem statement
            $table->unsignedTinyInteger('language_id')->nullable();             // Language ID
            $table->string('image_path', 256)->nullable();                // Image path
            $table->boolean('priority_check')->nullable();                      // Priority check (boolean)
            $table->string('file_id', 64)->nullable();                    // File ID (problem setting)
            $table->string('video_path', 256)->nullable();                // Video path
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
        Schema::dropIfExists('small_test_question_problems');
    }
}
