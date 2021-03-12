<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('chapter_id')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->json('questions')->nullable();
            $table->json('questions_allocated');
            $table->integer('total_questions');
            $table->integer('total_correct')->nullable();
            $table->string('result_status')->nullable();
            $table->float('percentage')->nullable();
            $table->bigInteger('time_spent')->default(0)->nullable();
            $table->enum('status', ['incomplete', 'complete'])->default('incomplete');
            $table->tinyInteger('is_final');
            $table->json('result')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');

            $table->foreign('chapter_id')
                  ->references('id')->on('training_chapters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_reports');
    }
}
