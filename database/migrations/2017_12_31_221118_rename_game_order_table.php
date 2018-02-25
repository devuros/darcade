<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameGameOrderTable extends Migration
{
    public function up()
    {
        if (Schema::hasTable('game_order'))
        {
            Schema::rename('game_order', 'purchases');
        }
    }

    public function down()
    {
        if (Schema::hasTable('purchases'))
        {
            Schema::rename('purchases', 'game_order');
        }
    }

}
