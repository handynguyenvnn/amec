<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->increments('id');                               // Version ID (auto increment)
            $table->char('relate_version', 50)->default(md5(time()));           // md5(time())
            $table->unsignedInteger('grade_id');                    // Grade ID
            $table->string('name', 64);                       // Version name
            $table->dateTime('release_date_chapter');               // Release date (Chapter)
            $table->dateTime('release_date_small_test');            // Release date (Small Test)
            $table->unsignedInteger('chapter_collection_id');       // Chapter collection ID (published)
            $table->unsignedInteger('small_test_id');               // Quiz ID (Publishing)
            $table->string('file_id_version', 64);            // File ID (version name)
            $table->string('folder_id_version', 64);          // Folder ID (version)
            $table->string('file_id_release', 64);            // File ID (release date)
            $table->boolean('published')->default(false);            // Determine current version is published or not
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
        Schema::dropIfExists('versions');
    }
}
