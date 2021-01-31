<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradeNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grade_names', function (Blueprint $table) {
            $table->increments('id');                       // Grade name ID
            $table->unsignedInteger('grade_id')->nullable();            // Grade ID
            $table->unsignedTinyInteger('language_id')->nullable();     // Language ID
            $table->string('name', 64)->nullable();               // Grade name
            $table->string('file_id', 64)->nullable();            // File ID (grade name)
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
        Schema::dropIfExists('grade_names');
    }
}
