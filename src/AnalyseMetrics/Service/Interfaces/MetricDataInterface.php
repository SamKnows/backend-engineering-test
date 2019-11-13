<?php

namespace App\AnalyseMetrics\Service\Interfaces;

interface MetricDataInterface
{
    public function getMetricValue(): float;
    public function getDateTime(): string;
}
