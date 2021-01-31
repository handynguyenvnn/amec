<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collections', function (Blueprint $table) {
            $table->increments('id');                       // Collection ID (auto increment)
            $table->string('name', 64);               // Collection name
            $table->unsignedInteger('maker_id');            // Maker ID
            $table->unsignedTinyInteger('language_id');     // Language ID
            $table->unsignedTinyInteger('level_id');        // Level ID
            $table->text('description');                    // Description
            $table->string('image_path', 256);        // Image path
            $table->integer('collection_no');               // Collection
            $table->string('youtube_link', 256);      // Youtube link
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
        Schema::dropIfExists('collections');
    }
}
