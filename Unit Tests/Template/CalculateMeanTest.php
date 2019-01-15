<?php

namespace Tests\Unit;

use App\Http\Helpers\TestHelper;
use App\Http\KeystrokeBasedAlgorithms\Algorithms\ManhattanScaled;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CalculateMeanTest extends TestCase
{

    public static function getExpectedMean($sample, $len)
    {
        $expected_mean = [];
        for ($i = 0; $i < $len; ++$i) {
            $expected_mean[$i] = 0;
            foreach ($sample as $key => $sample_item) {
                $expected_mean[$i] += $sample_item[$i];
            };
        }

        foreach ($expected_mean as $key => $item) {
            $expected_mean[$key] = $item / $len;
        }
        return $expected_mean;
    }

    private function getSample()
    {
        return TestHelper::getFirebaseDatabaseReference()
            ->getReference('/test_samples_for_mean_reference')
            ->getValue();
    }

    public static function getErrorMagnitude($a, $b)
    {
        return ($a - $b) * ($a - $b);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    /** @test */
    public function is_mean_calculated_correctly()
    {
        $sample = $this->getSample();
        $manscaled = new ManhattanScaled();
        $len = count($sample);
        $mean = $manscaled->Mean($sample, $len);
        $expected_mean = self::getExpectedMean($sample, $len);

        foreach ($mean as $key => $item) {
            $error_magnitude = self::getErrorMagnitude($expected_mean[$key], $mean[$key]);
            $this->assertLessThan(TestHelper::getErrorLimit(), $error_magnitude);
        }
    }
}
