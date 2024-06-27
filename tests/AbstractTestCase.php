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
use EightMarq\CoreBundle\Tests\Fixtures\Entity\User;
use EightMarq\CoreBundle\Tests\Services\DatabaseManager;
use PHPUnit\Framework\Attributes\CoversNothing;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
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
    private Security $security;

    protected function setUp(): void
    {
        self::bootKernel(['environment' => 'test', 'debug' => false]);

        $this->container = static::getContainer();

        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');
        $this->repository = $this->entityManager->getRepository($this->getEntityClass());
        $this->security = $this->container->get('symfony.context');

        /** @var DatabaseManager $databaseLoader */
        $databaseLoader = $this->container->get(DatabaseManager::class);
        $databaseLoader->reload();
    }

    protected function flush(bool $withClear = true): void
    {
        $this->entityManager->flush();

        if ($withClear) {
            // $this->entityManager->clear();
        }
    }

    protected function getEntity(int|Uuid|Ulid|null $id): object
    {
        return $this->repository->find($id);
    }

    protected function loginWithUser(User|null $user = null): User
    {
        $this->createRequestContext();

        if (null === $user) {
            $user = new User();
            $user->setEmail(sprintf('test-%s@example.com', uniqid()));
            $user->setPassword('test');

            $this->entityManager->persist($user);
            $this->flush();
        }

        $this->security->login($user);

        return $user;
    }

    protected function createRequestContext(): void
    {
        $session = new Session(new MockFileSessionStorage());
        $session->start();

        $request = Request::createFromGlobals();
        $request->setSession($session);

        $requestStack = $this->container->get('request_stack');
        $requestStack->push($request);
    }

    abstract protected function getEntityClass(): string;
}
