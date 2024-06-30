<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Tests\HttpKernel;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;

final class Kernel extends SymfonyKernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return __DIR__.'/..';
    }

    public function getCacheDir(): string
    {
        return $this->getProjectDir().'/../var/cache/'.$this->environment;
    }

    public function getLogDir(): string
    {
        return $this->getProjectDir().'/../var/log/'.$this->environment;
    }
}
