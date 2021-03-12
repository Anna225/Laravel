<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('option_key');
            $table->text('option_value')->nullable();
            $table->timestamps();
        });
        \DB::table('general_options')->insert(['option_key' => 'site_logo' , 'option_value' => '/storage/images/site-logo.png' ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('general_options');
    }
}
