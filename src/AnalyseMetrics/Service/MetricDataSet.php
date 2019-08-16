<?php
declare(strict_types=1);

namespace App\AnalyseMetrics\Service;

use App\AnalyseMetrics\Service\Interfaces\DataSetsInterface;

class MetricDataSet implements DataSetsInterface
{
    /**
     * @param array $items
     * @return array
     */
    public function series(array $items): array
    {
        $dataSet = [];
        foreach ($items as $item) {
            $dataSet[] = new MetricData($item->metricValue, $item->dtime);
        }

        return $dataSet;
    }
}
