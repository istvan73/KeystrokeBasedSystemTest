<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    private function getGoodUserData()
    {
        return [
            'type' => [
                'full_name' => 'Télenny Áron',
                'user_age' => 26,
                'username' => 'telinyari26',
                'email' => 'telinyari26@grammail.com',
                'training_password' => 'kisMacsk@99',
                'password' => 'password',
                'password_confirmation' => 'password',

            ],
            'select' => [
                'user_nationality' => 'HUN',
                'user_gender' => 'Male',
                'user_hand' => 'Right',
                'device' => 'PC'
            ]
        ];
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    /** @test */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/page')
                ->assertSee('Text')
                ->select('field', 'Item')
                ->screenshot('Screenshot path/file name')
                ->assertSee('Text');
        });
    }
}
