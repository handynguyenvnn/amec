<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comas', function (Blueprint $table) {
            $table->increments('id');                       // Frame ID (auto increment)
            $table->unsignedInteger('chapter_id');          // Chapter ID
            $table->string('frame_name', 64);         // Frame (Piece) name
            $table->smallInteger('frame_no');               // Frame (Piece) No => auto increment
            $table->unsignedInteger('coma_category_id');    // Frame category ID
            $table->string('file_id', 64);            // File ID (frame common setting)
            $table->string('folder_id', 64);          // Folder ID (frame)
            $table->string('control_no');                   // Management number (chapter) => hash value
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
        Schema::dropIfExists('comas');
    }
}
