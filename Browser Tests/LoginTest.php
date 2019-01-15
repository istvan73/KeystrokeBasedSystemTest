<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    /** @test */
    public function user_can_log_in()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/address')
                ->type('username', 'username text')
                ->type('password', 'password text')
                ->press('submit button id')
                ->assertPathIs('/path')
                ->assertSee('Text')->assertHasCookie('cookie');
        });
    }
}
