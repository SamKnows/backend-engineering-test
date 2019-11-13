<?php
declare(strict_types=1);

namespace App\AnalyseMetrics\Service;

use App\AnalyseMetrics\Service\Interfaces\AnalyserInterface;

class Analyser implements AnalyserInterface
{

    /**
     * @var array
     */
    private $metricValueSet = [];

    /**
     * @var array
     */
    private $dateSet = [];

    /**
     * Analyser constructor.
     * @param array $dataSet
     */
    public function __construct(array $dataSet)
    {
        foreach ($dataSet as $item) {
            $this->metricValueSet[] = $item->getMetricValue();
            $this->dateSet[] = $item->getDateTime();
        }
    }

    /**
     * @return MetricStatistics
     */
    public function parse(): MetricStatistics
    {
        return new MetricStatistics(
            $this->dateStart($this->dateSet),
            $this->dateEnd($this->dateSet),
            $this->avarageValue($this->metricValueSet),
            $this->maxValue($this->metricValueSet),
            $this->minValue($this->metricValueSet),
            $this->medianValue($this->metricValueSet),
            $this->underPerformance($this->metricValueSet, $this->dateSet)
        );
    }

    /**
     * @inheritDoc
     */
    public function dateStart(array $dateSet)
    {
        return min($dateSet);
    }

    /**
     * @inheritDoc
     */
    public function dateEnd(array $dateSet)
    {
        return max($dateSet);
    }

    /**
     * @inheritDoc
     */
    public function avarageValue(array $metricValueSet): float
    {
        return array_sum($metricValueSet) / count($metricValueSet);
    }

    /**
     * @inheritDoc
     */
    public function maxValue(array $metricValueSet): float
    {
        return max($metricValueSet);
    }

    /**
     * @inheritDoc
     */
    public function minValue(array $metricValueSet): float
    {
        return min($metricValueSet);
    }

    /**
     * @inheritDoc
     */
    public function medianValue(array $metricValueSet): float
    {
        sort($metricValueSet, SORT_NUMERIC);
        $number = count($metricValueSet);

        if ($number % 2 === 0) {
            // Even
            $middle = $number / 2;
            return ($metricValueSet[$middle - 1] + $metricValueSet[$middle]) / 2;
        } else {
            // Odd
            $middle = (int)floor($number / 2);
            return $metricValueSet[$middle];
        }
    }

    /**
     * @param array $metricValueSet
     * @param array $dateSet
     * @return array|null
     */
    public function underPerformance(array $metricValueSet, array $dateSet): ?array
    {
        $underPerformance = new UnderPerformance();
        $difference = $underPerformance->difference($this, $metricValueSet);

        foreach ($metricValueSet as $key => $metricItem) {
            if ($metricItem <= $this->avarageValue($metricValueSet) - (2 * $difference)) {
                $underPerformance->addDate($dateSet[$key]);
            }
        }

        return $underPerformance->dateRange();
    }
}
