<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorial_slides', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('training_chapter_id')->unsigned();
            $table->string('title');
            $table->longText('content');
            $table->integer('order')->nullable();
            $table->timestamps();

            $table->foreign('training_chapter_id')
                  ->references('id')->on('taining_chapters')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutorial_slides');
    }
}
