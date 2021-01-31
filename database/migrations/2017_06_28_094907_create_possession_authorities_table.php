<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePossessionAuthoritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('possession_authorities', function (Blueprint $table) {
            $table->increments('id');                           // Possession authority ID
            $table->unsignedInteger('account_id');              // Account ID
            $table->unsignedInteger('authority_id');            // Authority ID
            $table->boolean('authority_available');             // Authority presence or absence
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
        Schema::dropIfExists('possession_authorities');
    }
}
