<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePossessionCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('possession_certificates', function (Blueprint $table) {
            $table->increments('id');                   // Possession Certificate ID
            $table->unsignedInteger('user_id');         // User ID
            $table->unsignedInteger('certificate_id')->nullable();  // Certificate ID
            $table->dateTime('issue_date');             // Certificate issue date
            $table->string('photo_path', 256)->nullable();    // Photo path
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
        Schema::dropIfExists('possession_certificates');
    }
}
