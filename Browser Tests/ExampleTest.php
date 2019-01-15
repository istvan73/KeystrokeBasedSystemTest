<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    /** @test */
    public function is_error_shown_if_user_is_incorrect()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/address')
                ->assertSee('Text')
                ->type('username', 'IloveDusk')
                ->type('password', 'secret')
                ->press('submit button id')
                ->assertSee('error text');
        });
    }
}
