<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBigTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('big_tests', function (Blueprint $table) {
            $table->increments('id');                           // Large test ID (auto increment)
            $table->unsignedInteger('grade_id')->nullable();                // Grade ID
            $table->unsignedTinyInteger('pass_score_rate')->nullable();     // Pass score correct answer rate
            $table->string('control_no')->nullable();                       // Management/Control number (big test) => hash value
            $table->unsignedInteger('collection_id')->nullable();           // Collection ID
            $table->string('file_id', 64)->nullable();                // File ID (big test)
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
        Schema::dropIfExists('big_tests');
    }
}
