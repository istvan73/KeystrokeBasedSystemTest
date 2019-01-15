<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function testBasicTest()
    {
        $response = $this->get('/login');
//        $this->assertTrue(true);
        $response->assertStatus(200);
    }
}
