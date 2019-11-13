<?php
declare(strict_types=1);

namespace App\AnalyseMetrics\Service;

use App\AnalyseMetrics\Service\Interfaces\DataSetsInterface;

class FileDataFormatter
{
    /**
     * @var string
     */
    private $content;

    /**
     * @var DataSetsInterface
     */
    private $metricData;

    /**
     * FileDataFormatter constructor.
     * @param string $content
     * @param DataSetsInterface $metricData
     */
    public function __construct(string $content, DataSetsInterface $metricData)
    {
        $this->content = $content;
        $this->metricData = $metricData;
    }

    /**
     * @return array
     */
    public function getContent(): array
    {
        $content = json_decode($this->content);
        return $this->metricData->series($content->data[0]->metricData);
    }
}
