<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/login')
            ->type('mazeyarr@gmail.com', 'email')
            ->type('mazeyar123', 'password')
            ->press('login')
            ->seePageIs('/dashboard');
    }
}
