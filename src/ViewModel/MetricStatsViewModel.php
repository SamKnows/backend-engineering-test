<?php

namespace App\ViewModel;

use DateTime;

class MetricStatsViewModel
{
    /**
     * @var float
     */
    public $averageSpeed;

    /**
     * @var float
     */
    public $medianSpeed;

    /**
     * @var float
     */
    public $minimumSpeed;

    /**
     * @var float
     */
    public $maximumSpeed;

    /**
     * @var DateTime
     */
    public $fromDate;

    /**
     * @var DateTime
     */
    public $toDate;

    /**
     * @var bool
     */
    public $isMinimumTooLow;
}