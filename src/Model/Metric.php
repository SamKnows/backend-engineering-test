<?php

namespace App\Model;

use DateTime;

class Metric
{
    private $dateTime;
    private $bytesPerSecond;

    public function __construct(float $bytesPerSecond, DateTime $dateTime)
    {
        $this->bytesPerSecond = $bytesPerSecond;
        $this->dateTime = $dateTime;
    }

    public function bytesPerSecond(): float
    {
        return $this->bytesPerSecond;
    }

    public function dateTime(): DateTime
    {
        return $this->dateTime;
    }
}