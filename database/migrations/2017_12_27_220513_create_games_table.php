<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    public function up()
    {
        Schema::create('games', function (Blueprint $table)
        {

            $table->increments('id');
            $table->string('title');
            $table->string('image');
            $table->timestamp('release_date')->nullable();
            $table->text('description');
            $table->text('about');
            $table->unsignedInteger('developer_id');
            $table->unsignedInteger('publisher_id');
            $table->float('base_price', 4, 2);
            $table->float('sale_price', 4, 2)->nullable();
            $table->boolean('is_on_sale')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('games');
    }

}
