<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGamesTable extends Migration
{
    public function up()
    {
        Schema::table('games', function (Blueprint $table)
        {
            $table->boolean('is_featured')->nullable(false)->after('is_on_sale');
        });
    }

    public function down()
    {
        Schema::table('games', function (Blueprint $table)
        {
            $table->dropColumn('is_featured');
        });
    }

}
