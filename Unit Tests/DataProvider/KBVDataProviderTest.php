<?php

namespace Tests\Unit\DataProvider;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\KeystrokeBasedAlgorithms\Persistence\FirebaseKBADatabase;
use App\Http\KeystrokeBasedAlgorithms\Persistence\KBADatabase;

class KBV_DataProviderTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function class_implements_interface()
    {
        $firebase_provider = new FirebaseKBADatabase();
        self::assertTrue($firebase_provider instanceof KBADatabase);
    }


}
