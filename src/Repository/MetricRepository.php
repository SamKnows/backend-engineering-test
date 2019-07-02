<?php

namespace App\Repository;

use App\Model\Metric;
use App\Model\MetricCollection;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use DateTime;

class MetricRepository
{
    private const METRIC_VALUE_INDEX = 'metricValue';
    private const METRIC_DTIME_INDEX = 'dtime';

    public function getMetricsFromData(array $rawMetrics): MetricCollection
    {
        $metricsCollection = new MetricCollection();
        foreach ($rawMetrics as $rawMetric) {
            $metric = new Metric(
                $rawMetric[self::METRIC_VALUE_INDEX],
                new DateTime($rawMetric[self::METRIC_DTIME_INDEX])
            );
            $metricsCollection->add($metric);
        }

        return $metricsCollection;
    }
}