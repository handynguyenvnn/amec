<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');                     // Grade ID
            $table->unsignedInteger('project_id')->nullable();        // Project ID
            $table->unsignedSmallInteger('grade_no')->nullable();     // Grade No
            $table->boolean('content_type')->nullable();              // Content type
            $table->string('folder_id', 64)->nullable();        // Folder ID (grade)
            $table->string('file_id', 64)->nullable();          // File ID (grade setting)
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
        Schema::dropIfExists('grades');
    }
}
