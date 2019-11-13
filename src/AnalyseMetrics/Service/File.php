<?php
declare(strict_types=1);

namespace App\AnalyseMetrics\Service;

class File
{
    /**
     * @var string
     */
    private $file = null;

    /**
     * File constructor.
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function read(): string
    {
        if ($this->file === null || empty($this->file)) {
            throw new \Exception('Invalid file name');
        }

        $content = file_get_contents($this->file, true);

        if ($content === false) {
            throw new \Exception('Error in reading file');
        }

        return $content;
    }
}
