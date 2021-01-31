<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_videos', function (Blueprint $table) {
            $table->increments('id');                            // Advertisement video ID
            $table->unsignedInteger('ad_id')->nullable();                    // Advertisement ID
            $table->string('image_animation_path', 256)->nullable();   // Image animation path
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
        Schema::dropIfExists('ad_videos');
    }
}
