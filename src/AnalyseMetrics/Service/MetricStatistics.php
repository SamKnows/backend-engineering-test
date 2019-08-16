<?php
declare(strict_types=1);

namespace App\AnalyseMetrics\Service;

class MetricStatistics
{
    /**
     * @var string
     */
    private $dateStart;

    /**
     * @var string
     */
    private $dateEnd;

    /**
     * @var float
     */
    private $avarageValue;

    /**
     * @var float
     */
    private $maxValue;

    /**
     * @var float
     */
    private $minValue;

    /**
     * @var float
     */
    private $medianValue;

    /**
     * @var float
     */
    private $underperformance;

    /**
     * MetricStatistics constructor.
     * @param $dateStart
     * @param $dateEnd
     * @param $avarageValue
     * @param $maxValue
     * @param $minValue
     * @param $medianValue
     * @param $underperformance
     */
    public function __construct(
        $dateStart,
        $dateEnd,
        $avarageValue,
        $maxValue,
        $minValue,
        $medianValue,
        $underperformance
    ) {
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->avarageValue = $avarageValue;
        $this->maxValue = $maxValue;
        $this->minValue = $minValue;
        $this->medianValue = $medianValue;
        $this->underperformance = $underperformance;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'dateStart' => $this->dateStart,
            'dateEnd' => $this->dateEnd,
            'avg' => $this->avarageValue,
            'max' => $this->maxValue,
            'min' => $this->minValue,
            'median' => $this->medianValue,
            'underperformance' => $this->underperformance
        ];
    }
}
