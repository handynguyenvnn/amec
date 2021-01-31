<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->increments('id');                   // Chapter ID
            $table->unsignedInteger('version_id')->nullable();      // Version ID
            $table->string('control_no')->nullable();               // Management/control number (chapter) => hash value
            $table->unsignedInteger('collection_id')->nullable();   // Collection ID
            $table->smallInteger('chapter_no')->nullable();         // Chapter No (auto increment)
            $table->string('folder_id', 64)->nullable();      // Folder ID (chapter)
            $table->string('file_id', 64)->nullable();        // File ID (chapter setting)
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
        Schema::dropIfExists('chapters');
    }
}
