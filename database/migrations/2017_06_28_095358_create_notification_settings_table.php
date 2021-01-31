<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_settings', function (Blueprint $table) {
            $table->increments('id');                                   // Notification setting ID (auto increment)
            $table->unsignedTinyInteger('language_id');                 // Language ID
            $table->unsignedSmallInteger('notification_1_term');        // Notification 1 period/term
            $table->boolean('notification_1_setting');                  // Notification 1 setting
            $table->text('notification_1_description');                 // Notification 1 description
            $table->unsignedSmallInteger('notification_2_term');        // Notification 2 period/term
            $table->text('notification_2_description');                 // Notification 2 description
            $table->boolean('notification_2_setting');                  // Notification 2 setting
            $table->unsignedSmallInteger('notification_3_term');        // Notification 3 period/term
            $table->text('notification_3_description');                 // Notification 3 description
            $table->boolean('notification_3_setting');                  // Notification 3 setting
            $table->unsignedSmallInteger('notification_4_term');        // Notification 4 period/term
            $table->text('notification_4_description');                 // Notification 4 description
            $table->boolean('notification_4_setting');                  // Notification 4 setting
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
        Schema::dropIfExists('notification_settings');
    }
}
