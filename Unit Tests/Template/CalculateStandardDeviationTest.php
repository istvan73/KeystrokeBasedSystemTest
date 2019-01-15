<?php

namespace Tests\Unit;

use App\Http\Helpers\TestHelper;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\KeystrokeBasedAlgorithms\Algorithms\ManhattanScaled;

class CalculateStandardDeviationTest extends TestCase
{
    private function getExectedStandardDeviation($sample, $mean, $len)
    {
        $std_devs = [];
        for ($i = 0; $i < $len; ++$i) {
            $std_devs[$i] = 0;
            foreach ($sample as $sample_item) {
                $std_devs[$i] += abs($sample_item[$i] - $mean[$i]);
            };
        }
        foreach ($std_devs as $key => $item) {
            $std_devs[$key] = $item / ($len - 1);
        }
        return $std_devs;
    }

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
    /** @test */
    public function does_standard_deviation_get_calculated_properly()
    {
        $sample = $this->getSample();
        $len = count($sample);
        $mean = CalculateMeanTest::getExpectedMean($sample, $len);

        $std_dev = (new ManhattanScaled())->StandardDeviation($sample, $mean, $len);
        $expected_std_dev = $this->getExectedStandardDeviation($sample, $mean, $len);

        foreach ($mean as $key => $item) {
            $error_magnitude = CalculateMeanTest::getErrorMagnitude($expected_std_dev[$key], $std_dev[$key]);
            $this->assertLessThan(TestHelper::getErrorLimit(), $error_magnitude);
        }
    }
}
