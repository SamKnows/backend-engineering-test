<?php
declare(strict_types=1);

namespace App\AnalyseMetrics\Service;

use App\AnalyseMetrics\Service\Interfaces\MetricDataInterface;

class MetricData implements MetricDataInterface
{
    /**
     * @var float $metricValue
     */
    private $metricValue;

    /**
     * @var string dtime
     */
    private $dtime;

    /**
     * MetricData constructor.
     * @param $metricValue
     * @param $dtime
     */
    public function __construct($metricValue, $dtime)
    {
        $this->metricValue = $metricValue;
        $this->dtime = $dtime;
    }

    /**
     * @return float
     */
    public function getMetricValue(): float
    {
        return $this->metricValue;
    }

    /**
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dtime;
    }
}
