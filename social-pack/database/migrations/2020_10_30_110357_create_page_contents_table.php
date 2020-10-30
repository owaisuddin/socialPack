<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->autoIncrementingStartingValues();
            $table->string('page_id');
            $table->string('content')->nullable(true);
            $table->string('link')->nullable(true);
            $table->string('photo')->nullable(true);
            $table->string('video')->nullable(true);
            $table->string('schedule_time')->nullable(true);
            $table->string('page_post_id')->nullable(true);
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
        Schema::dropIfExists('page_contents');
    }
}
