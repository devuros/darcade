<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameTest extends TestCase
{
    /**
     * Test Skeleton RPG exists
     */
    public function testSkeletonGameExists()
    {

    	$this->assertDatabaseHas('games', [

        	'title'=> 'Skeleton RPG'

        ]);

    }
}
