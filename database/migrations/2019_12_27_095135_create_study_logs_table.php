<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudyLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('training_chapter_id');
            $table->bigInteger('time_spent')->default(0)->nullable();
            $table->unsignedBigInteger('last_visited_slide');

            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('training_chapter_id')
                  ->references('id')->on('training_chapters')
                  ->onDelete('cascade');

            $table->foreign('last_visited_slide')
                  ->references('id')->on('tutorial_slides');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_logs');
    }
}
