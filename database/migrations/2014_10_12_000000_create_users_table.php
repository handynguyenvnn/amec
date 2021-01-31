<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');                                   // User ID
            $table->string('email', 256);                         // E-mail address
            $table->string('password');                                 // Password varchar (64)
            $table->unsignedTinyInteger('language_id');                 // Language ID
            $table->string('username', 64);                       // User name
            $table->boolean('gender');                                  // Gender
            $table->date('birth_date')->nullable();                     // Birth date
            $table->unsignedTinyInteger('area_id');                     // Area ID
            $table->unsignedTinyInteger('profession_id');               // Profession/Occupation ID
            $table->string('address', 500)->nullable();           // Address
            $table->string('phone', 16)->nullable();                          // Telephone number
            $table->dateTime('registration_date');                      // User registration date
            $table->dateTime('last_login_date')->nullable();            // Last login date
            $table->boolean('notification_setting_1')->default(true);   // Prompt notice setting:1 / non notification setting:0 ①
            $table->boolean('notification_setting_2')->default(true);   // Prompt notice setting:1 / non notification setting:0 ②
            $table->boolean('notification_setting_3')->default(true);   // Prompt notice setting:1 / non notification setting:0 ③
            $table->text('contents')->nullable();                       // Contents
            $table->boolean('sns_public_setting')->default(true);       // SNS public setting
            $table->string('ios_token', 256)->nullable();         // Device ID => added
            $table->string('firebase_token', 256)->nullable();    // Firebase token => added
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
        Schema::dropIfExists('users');
    }
}
