<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameGenreTable extends Migration
{
    public function up()
    {
        Schema::create('game_genre', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('game_id');
            $table->unsignedInteger('genre_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_genre');
    }

}
