<?php


namespace App\AnalyseMetrics\Service\Interfaces;

use App\AnalyseMetrics\Service\MetricStatistics;
use App\AnalyseMetrics\Service\UnderPerformance;

interface AnalyserInterface
{

    /**
     * @return MetricStatistics
     */
    public function parse(): MetricStatistics;

    /**
     * @param array $dateSet
     * @return mixed
     */
    public function dateStart(array $dateSet);

    /**
     * @param array $dateSet
     * @return mixed
     */
    public function dateEnd(array $dateSet);

    /**
     * @param array $metricValueSet
     * @return float
     */
    public function avarageValue(array $metricValueSet): float;

    /**
     * @param array $metricValueSet
     * @return float
     */
    public function minValue(array $metricValueSet): float;

    /**
     * @param array $metricValueSet
     * @return float
     */
    public function maxValue(array $metricValueSet): float;

    /**
     * @param array $metricValueSet
     * @return float
     */
    public function medianValue(array $metricValueSet): float;

    /**
     * @param array $metricValueSet
     * @return float
     */
    public function underPerformance(array $metricValueSet, array $dateSet): ?array;
}
