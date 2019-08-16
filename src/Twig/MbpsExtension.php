<?php
declare(strict_types=1);

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MbpsExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('Mbps', [$this, 'convertToMbps']),
        ];
    }

    public function convertToMbps(float $bytes): float
    {
        return round($bytes * 8 / 1000000, 2);
    }
}
