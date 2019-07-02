<?php

namespace App\Service;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Exception;

class DataService
{
    private const JSON_DATA_INDEX = 'data';
    private const JSON_CODE_INDEX = 'code';

    public function getJsonFromFile(string $file): array
    {
        if (!file_exists($file)) {
            throw new FileNotFoundException();
        }

        if (!is_readable($file)) {
            throw new Exception("No readable File");
        }

        $fileContent = file_get_contents($file);
        $jsonData = json_decode($fileContent, true);

        if (!isset($jsonData[self::JSON_CODE_INDEX]) || $jsonData[self::JSON_CODE_INDEX] !== 'OK') {
            throw new Exception("No Valid response");
        }

        if (!isset($jsonData[self::JSON_DATA_INDEX])) {
            throw new Exception("No Data returned");
        }

        return $jsonData[self::JSON_DATA_INDEX];
    }
}