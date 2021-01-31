<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmallTestQuestionChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('small_test_question_choices', function (Blueprint $table) {
            $table->increments('id');                               // Choice ID int AI
            $table->unsignedInteger('small_test_question_id')->nullable();      // Small test question ID
            $table->text('option_description')->nullbale();                     // Option Description
            $table->unsignedInteger('choice_no')->nullbale();                   // Choice No
            $table->unsignedTinyInteger('language_id')->nullbale();             // Language ID
            $table->boolean('option_value')->nullbale();                        // True or False boolean
            $table->string('image_path', 256)->nullbale();                // Image path
            $table->string('file_id_explanation', 64)->nullbale();        // File ID (option explanation)
            $table->string('file_id_setting', 64)->nullbale();            // File ID (option setting)
            $table->string('folder_id', 64)->nullbale();                  // Folder ID (choice)
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
        Schema::dropIfExists('small_test_question_choices');
    }
}
