<?php

namespace App\AnalyseMetrics\Service\Interfaces;

interface DataSetsInterface
{
    public function series(array $items): array;
}
