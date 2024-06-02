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

namespace EightMarq\CoreBundle\Tests;

use Doctrine\ORM\EntityManagerInterface;
use EightMarq\CoreBundle\Tests\HttpKernel\Kernel;
use EightMarq\CoreBundle\Tests\Services\DatabaseManager;
use PHPUnit\Framework\Attributes\CoversNothing;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

#[CoversNothing]
class AbstractTestCase extends KernelTestCase
{
    protected KernelInterface $testKernel;
    protected EntityManagerInterface $entityManager;
    protected ContainerInterface $container;

    protected function setUp(): void
    {
        $this->testKernel = new Kernel($this->getExtraConfigs());
        $this->testKernel->boot();

        $this->container = $this->testKernel->getContainer();

        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');

        /** @var DatabaseManager $databaseLoader */
        $databaseLoader = $this->container->get(DatabaseManager::class);
        $databaseLoader->reload();
    }

    protected function getExtraConfigs(): array
    {
        return [];
    }
}
