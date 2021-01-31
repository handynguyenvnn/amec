<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePossessionCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('possession_collections', function (Blueprint $table) {
            $table->increments('id');                   // Possession Collection ID
            $table->unsignedInteger('user_id');         // User ID
            $table->unsignedInteger('collection_id');   // Collection ID
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
        Schema::dropIfExists('possession_collections');
    }
}
