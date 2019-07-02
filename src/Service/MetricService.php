<?php

namespace App\Service;

use App\Model\MetricCollection;
use App\Repository\MetricRepository;
use Exception;

class MetricService
{
    private const JSON_METRIC_DATA_INDEX = 'metricData';
    /**
     * @var MetricRepository
     */
    private $metricRepository;

    /**
     * @var DataService
     */
    private $dataService;

    public function __construct(
        MetricRepository $metricRepository,
        DataService $dataService
    ) {
        $this->metricRepository = $metricRepository;
        $this->dataService = $dataService;
    }

    /**
     * @param string $file
     * @return MetricCollection
     * @throws Exception
     *
     * Here we get the data generically from a data service, would it be more complex
     * maybe we would just give a URI to dataService and it would know if he's getting
     * data from guzzle or file or anything?
     *
     * Then here we get the content of ["data"] then this knows that it has to have
     * a metricData index too, whose content is then given to the repository which
     * knows how to build the objects
     */
    public function getMetricsFromFile(string $file): MetricCollection
    {
        $jsonDataChunks = $this->dataService->getJsonFromFile($file);
        foreach ($jsonDataChunks as $jsonDataChunk) {
            if (isset($jsonDataChunk[self::JSON_METRIC_DATA_INDEX])) {
                return $this->metricRepository->getMetricsFromData($jsonDataChunk[self::JSON_METRIC_DATA_INDEX]);
            }
        }

        throw new Exception("No Metric Data Found");
    }
}