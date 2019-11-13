<?php
declare(strict_types=1);

namespace App\Service;

use Symfony\Component\HttpKernel\KernelInterface;

class Twig extends \Twig
{
    public function __construct(KernelInterface $kernel)
    {
        $loader = new \Twig_Loader_Filesystem($kernel->getProjectDir());
        parent::__construct($loader);
    }
}
