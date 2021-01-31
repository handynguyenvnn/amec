<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXmlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xmls', function (Blueprint $table) {
            $table->increments('id');                     // Grade ID
            $table->unsignedInteger('language_id')->nullable();    // lang ID
            $table->string('name', 64)->nullable();        // name
            $table->unsignedInteger('content_type')->nullable();  // content_type
            $table->string('version_name', 64)->nullable();        // version_name
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
        Schema::dropIfExists('xmls');
    }
}
