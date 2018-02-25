<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreenshotsTable extends Migration
{
    public function up()
    {
        Schema::create('screenshots', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('path');
            $table->unsignedInteger('game_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('screenshots');
    }

}
