<?php
declare(strict_types=1);

namespace App\AnalyseMetrics\Service;

class UnderPerformance
{
    /**
     * @var array
     */
    private $dateRange = [];

    /**
     * @param Analyser $analyser
     * @param array $metricValueSet
     * @return float
     */
    public function difference(Analyser $analyser, array $metricValueSet): float
    {
        $avarage = $analyser->avarageValue($metricValueSet);
        $sum = 0;
        foreach ($metricValueSet as $value) {
            $sum += pow($value - $avarage, 2);
        }

        return sqrt($sum / count($metricValueSet));
    }

    /**
     * @param $date
     */
    public function addDate($date)
    {
        $this->dateRange[] = $date;
    }

    /**
     * @return array|null
     */
    public function dateRange(): ?array
    {
        if (count($this->dateRange) === 0) {
            return null;
        }

        return [
            'start' => min($this->dateRange),
            'end' => max($this->dateRange)
        ];
    }
}
