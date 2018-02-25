<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    public function testUrosJovanovicExists()
    {
        $this->assertDatabaseHas('users', [
        	'name'=> 'Uros Jovanovic',
        	'email'=> 'urosjovanovic0704@gmail.com'
        ]);
    }

    public function testMilosRadosavljevicExists()
    {
    	$this->assertDatabaseHas('users', [
        	'name'=> 'Milos Radosavljevic',
        	'email'=> 'milos@example.com'
        ]);
    }

}
