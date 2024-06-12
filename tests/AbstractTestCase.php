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
use Doctrine\ORM\EntityRepository;
use EightMarq\CoreBundle\Tests\HttpKernel\Kernel;
use EightMarq\CoreBundle\Tests\Services\DatabaseManager;
use PHPUnit\Framework\Attributes\CoversNothing;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Uid\Ulid;
use Symfony\Component\Uid\Uuid;

#[CoversNothing]
abstract class AbstractTestCase extends KernelTestCase
{
    protected KernelInterface $testKernel;
    protected EntityManagerInterface $entityManager;
    protected ContainerInterface $container;
    private EntityRepository $repository;

    protected function setUp(): void
    {
        $this->testKernel = new Kernel($this->getExtraConfigs());
        $this->testKernel->boot();

        $this->container = $this->testKernel->getContainer();

        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');
        $this->repository = $this->entityManager->getRepository($this->getEntityClass());

        /** @var DatabaseManager $databaseLoader */
        $databaseLoader = $this->container->get(DatabaseManager::class);
        $databaseLoader->reload();
    }

    protected function getExtraConfigs(): array
    {
        return [];
    }

    protected function flush(bool $withClear = true): void
    {
        $this->entityManager->flush();

        if ($withClear) {
            $this->entityManager->clear();
        }
    }

    protected function getEntity(int|Uuid|Ulid|null $id): object
    {
        return $this->repository->find($id);
    }

    abstract protected function getEntityClass(): string;
}
