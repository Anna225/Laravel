<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeSliderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_slider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('heading');
            $table->string('subheading')->nullable();
            $table->string('image');
            $table->string('cta_label','100')->nullable();
            $table->string('cta_link')->nullable();
            $table->string('cta_target','50')->default('_self');
            $table->integer('order')->nullable();
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
        Schema::dropIfExists('home_slider');
    }
}
