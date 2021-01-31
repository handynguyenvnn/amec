<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyBackgroundPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_background_pages', function (Blueprint $table) {
            $table->increments('id');                   // My Page Background ID
            $table->unsignedInteger('user_id')->nullable();         // User ID
            $table->unsignedInteger('grade_id')->nullable();        // Grade ID
            $table->string('image_path', 256)->nullable();    // Image path
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
        Schema::dropIfExists('my_background_pages');
    }
}
