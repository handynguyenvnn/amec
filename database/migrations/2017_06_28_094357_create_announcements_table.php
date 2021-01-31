<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->increments('id');                   // Notice ID
            $table->string('subject', 256)->nullable();        // Subject line
            $table->tinyInteger('language_id')->nullable();         // Language ID
            $table->text('description')->nullable();                // Description
            $table->tinyInteger('area_id')->nullable();             // Area ID
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
        Schema::dropIfExists('announcements');
    }
}
