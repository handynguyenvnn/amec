<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapterNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapter_names', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('chapter_id')->nullable();
            $table->unsignedTinyInteger('language_id')->nullable();
            $table->string('name', 64)->nullable();
            $table->string('file_id', 64)->nullable();
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
        Schema::dropIfExists('chapter_names');
    }
}
