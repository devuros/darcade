<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameOrderTable extends Migration
{
    public function up()
    {
        Schema::create('game_order', function (Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('game_id');
            $table->unsignedInteger('order_id');
            $table->float('actual_price', 6, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('game_order');
    }

}
