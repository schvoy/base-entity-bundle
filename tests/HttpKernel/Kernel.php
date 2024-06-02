<?php

/**
 * This file is part of the EightMarq Symfony bundles.
 *
 * (c) Norbert Schvoy <norbert.schvoy@eightmarq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EightMarq\CoreBundle\Tests\HttpKernel;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use EightMarq\CoreBundle\CoreBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as SymfonyKernel;

final class Kernel extends SymfonyKernel
{
    public function __construct(private readonly array $configs = [])
    {
        parent::__construct('test', false);
    }

    public function registerBundles(): array
    {
        return [new CoreBundle(), new DoctrineBundle(), new FrameworkBundle()];
    }

    public function getCacheDir(): string
    {
        return sys_get_temp_dir().'/core_test';
    }

    public function getLogDir(): string
    {
        return sys_get_temp_dir().'/core_test_log';
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__.'/../config/config.php');

        foreach ($this->configs as $config) {
            $loader->load($config);
        }
    }
}
