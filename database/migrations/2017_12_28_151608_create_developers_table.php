<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevelopersTable extends Migration
{
    public function up()
    {
        Schema::create('developers', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('developer');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('developers');
    }

}
