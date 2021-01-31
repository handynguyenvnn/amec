<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardAppearanceRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_appearance_rates', function (Blueprint $table) {
            $table->increments('id');                           // Occurrence rate ID
            $table->unsignedInteger('collection_id');           // Collection ID
            $table->unsignedInteger('user_id');                 // User ID
            $table->unsignedInteger('level_id');                // Level ID
            $table->unsignedTinyInteger('occurrence_rate');     // Occurrence rate
            $table->boolean('has_gacha');                       // Gacha ON_OFF
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
        Schema::dropIfExists('card_appearance_rates');
    }
}
