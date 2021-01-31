<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrophySettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trophy_settings', function (Blueprint $table) {
            $table->increments('id');                             // Trophy setting ID (auto increment)
            $table->unsignedInteger('big_test_id');               // Big test ID
            $table->unsignedTinyInteger('collection_id');         // Collection ID
            $table->unsignedTinyInteger('correct_answer_rate');   // Correct answer rate
            $table->string('folder_id', 64);                // Folder ID (Trophy setting)
            $table->string('file_id', 64);                  // File ID (Trophy setting)
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
        Schema::dropIfExists('trophy_settings');
    }
}
