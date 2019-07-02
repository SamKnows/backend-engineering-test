<?php

namespace App\Model;

class MetricCollection
{
    /**
     * @var Metric[]
     */
    private $metrics;

    public function __construct()
    {
        $this->metrics = [];
    }

    public function add(Metric $metric): void
    {
        $this->metrics[] = $metric;
    }

    public function fromDate()
    {
        return array_reduce($this->metrics, static function ($carry, Metric $metric) {
            if (is_null($carry)) {
                $carry = $metric->dateTime();
            }

            if ($carry > $metric->dateTime()) {
                $carry = $metric->dateTime();
            }

            return $carry;
        });
    }

    public function toDate()
    {
        return array_reduce($this->metrics, static function ($carry, Metric $metric) {
            if (is_null($carry)) {
                $carry = $metric->dateTime();
            }

            if ($metric->dateTime() > $carry) {
                $carry = $metric->dateTime();
            }

            return $carry;
        });
    }

    public function averageSpeed()
    {
        return array_reduce($this->metrics, static function ($carry, Metric $metric) {
            $carry += $metric->bytesPerSecond();
            return $carry;
        }) / count($this->metrics);
    }

    public function medianSpeed()
    {
        $speeds = [];
        array_map(static function (Metric $metric) use (&$speeds) {
            $speeds[] = $metric->bytesPerSecond();
        }, $this->metrics);
        sort($speeds);
        $medianIndex = floor(count($speeds) / 2);

        return $speeds[$medianIndex];
    }

    public function minimumSpeed()
    {
        return array_reduce($this->metrics, static function ($carry, Metric $metric) {
            if (is_null($carry)) {
                $carry = $metric->bytesPerSecond();
            }

            if ($carry > $metric->bytesPerSecond()) {
                $carry = $metric->bytesPerSecond();
            }

            return $carry;
        });
    }

    public function maximumSpeed()
    {
        return array_reduce($this->metrics, static function ($carry, Metric $metric) {
            if (is_null($carry)) {
                $carry = $metric->bytesPerSecond();
            }

            if ($metric->bytesPerSecond() > $carry) {
                $carry = $metric->bytesPerSecond();
            }

            return $carry;
        });
    }

    public function underperformingPeriod()
    {
        // I Guess here I would get the average speed, then check each of
        // the entries to see if at a given time if was less than the half of it?
    }
}