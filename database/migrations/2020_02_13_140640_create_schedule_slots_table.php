<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleSlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_slots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('event');
            $table->string('venue');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_slots');
            $table->enum('status', ['available','full'])->default('available');
            $table->bigInteger('service_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('service_id')
                  ->references('id')->on('services')
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
        Schema::dropIfExists('schedule_slots');
    }
}
