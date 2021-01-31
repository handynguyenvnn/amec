<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tips', function (Blueprint $table) {
            $table->increments('id');                   // TIPS ID
            $table->unsignedInteger('project_id');      // Project ID
            $table->boolean('has_small_test');          // With or without small test
            $table->string('control_no');               // Management/Control number (TIPS)
            $table->string('file_id', 64);        // File ID (TIPS setting)
            $table->string('folder_id', 64);      // Folder ID (TIPS)
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
        Schema::dropIfExists('tips');
    }
}
