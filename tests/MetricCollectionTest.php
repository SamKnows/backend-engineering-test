<?php

namespace App\Tests;

use App\Model\Metric;
use App\Repository\MetricRepository;
use PHPUnit\Framework\TestCase;

class MetricCollectionTest extends TestCase
{
    /**
     * @dataProvider metricCollectionAverageDataCollection
     */
    public function testMetricCollectionAverageSpeed($expected, $speeds)
    {
        $repository = new MetricRepository();
        $metrics = $repository->getMetricsFromData($speeds);

        $this->assertEquals($expected, $metrics->averageSpeed());
    }

    public function metricCollectionAverageDataCollection()
    {
        return [
            [
                'expected' => 925.0,
                'speeds' => $this->metricCollectionSpeeds()
            ]
        ];
    }

    /**
     * @dataProvider metricCollectionMinimumDataCollection
     */
    public function testMetricCollectionMinimumSpeed($expected, $speeds)
    {
        $repository = new MetricRepository();
        $metrics = $repository->getMetricsFromData($speeds);

        $this->assertEquals($expected, $metrics->minimumSpeed());
    }

    public function metricCollectionMinimumDataCollection()
    {
        return [
            [
                'expected' => 200.0,
                'speeds' => $this->metricCollectionSpeeds()
            ]
        ];
    }

    public function metricCollectionSpeeds()
    {
        return [
            ['metricValue' => 2000.0, 'dtime' => 'now'],
            ['metricValue' => 1000.0, 'dtime' => 'now'],
            ['metricValue' => 500.0, 'dtime' => 'now'],
            ['metricValue' => 200.0, 'dtime' => 'now']
        ];
    }
}