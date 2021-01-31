<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComaLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coma_languages', function (Blueprint $table) {
            $table->increments('id');                               // Frame (Language) ID (auto increment)
            $table->unsignedInteger('coma_id')->nullable();                     // Frame ID
            $table->string('music_path', 256)->nullable();                // Music path
            $table->text('description')->nullable();                            // Description
            $table->unsignedTinyInteger('language_id')->nullable();             // Language ID
            $table->string('video_path', 256)->nullable();                // Video path
            $table->boolean('priority_check')->nullable();                      // Priority check
            $table->string('file_id', 64)->nullable();                    // File ID (frame language setting)
            $table->string('image_path', 256)->nullable();                // Image path
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
        Schema::dropIfExists('coma_languages');
    }
}
