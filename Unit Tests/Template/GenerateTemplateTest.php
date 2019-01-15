<?php

namespace Tests\Unit;

use App\Http\Helpers\TestHelper;
use App\Http\KeystrokeBasedAlgorithms\Algorithms\ManhattanScaled;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GenerateTemplateTest extends TestCase
{

    private function getSample()
    {
        return TestHelper::getFirebaseDatabaseReference()
            ->getReference('/test_samples_for_mean_reference')
            ->getValue();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $sample = $this->getSample();
        $sample_length = count($sample[0]);
        $template = (new ManhattanScaled())->GenerateTemplate($sample);
        $this->assertArrayHasKey('mu', $template);
        $this->assertArrayHasKey('sigma', $template);

        $this->assertEquals($sample_length, count($template['mu']));
        $this->assertEquals($sample_length, count($template['sigma']));
    }
}
