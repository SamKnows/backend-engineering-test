<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MegabitConverter extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            'bytesToMegabit' => new TwigFilter('bytesToMegabit', [$this, 'bytesToMegabit'])
        ];
    }

    public function bytesToMegabit($bytes): float
    {
        return $bytes * 0.000008;
    }
}