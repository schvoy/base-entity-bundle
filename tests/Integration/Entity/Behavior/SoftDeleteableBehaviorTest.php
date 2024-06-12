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

namespace EightMarq\CoreBundle\Tests\Integration\Entity\Behavior;

use DateTime;
use EightMarq\CoreBundle\Tests\AbstractTestCase;
use EightMarq\CoreBundle\Tests\Fixtures\Entity\Behavior\SoftDeleteableEntity;
use Override;
use PHPUnit\Framework\Attributes\CoversNothing;

#[CoversNothing]
class SoftDeleteableBehaviorTest extends AbstractTestCase
{
    public function testSoftDeleteableBehaviorDeleteImmediately(): void
    {
        $entity = new SoftDeleteableEntity();

        // Create
        $entity->setValue('Value');

        $this->entityManager->persist($entity);
        $this->flush();

        $id = $entity->getId();
        $this->assertNotNull($id);

        // Soft delete
        $entity = $this->getEntity($id);

        $this->entityManager->remove($entity);
        $this->flush();

        // Fetch after remove
        $entity = $this->getEntity($id);

        $this->assertNotNull($entity->getDeletedAt());
        $this->assertTrue($entity->isDeleted());
    }

    public function testSoftDeleteableBehaviorDeleteLater(): void
    {
        $entity = new SoftDeleteableEntity();

        // Create
        $entity->setValue('Value');

        $this->entityManager->persist($entity);
        $this->flush();

        $id = $entity->getId();
        $this->assertNotNull($id);

        // Soft delete manually

        $entity = $this->getEntity($id);
        $entity->setDeletedAt(new DateTime('+ 2 days'));

        $this->flush();

        // Fetch after remove
        $entity = $this->getEntity($id);

        $this->assertNotNull($entity->getDeletedAt());
        $this->assertFalse($entity->isDeleted());
        $this->assertFalse($entity->willBeDeleted(new DateTime('+1 day')));
        $this->assertTrue($entity->willBeDeleted(new DateTime('+3 days')));
    }

    public function testSoftDeleteableBehaviorRestore(): void
    {
        $entity = new SoftDeleteableEntity();

        // Create
        $entity->setValue('Value');

        $this->entityManager->persist($entity);
        $this->flush();

        $id = $entity->getId();
        $this->assertNotNull($id);

        // Soft delete
        $entity = $this->getEntity($id);

        $this->entityManager->remove($entity);
        $this->flush();

        // Fetch after remove
        $entity = $this->getEntity($id);

        $this->assertNotNull($entity->getDeletedAt());
        $this->assertTrue($entity->isDeleted());

        // Restore

        $entity->restore();
        $this->flush();

        // Fetch after restore
        $entity = $this->getEntity($id);

        $this->assertNull($entity->getDeletedAt());
        $this->assertFalse($entity->isDeleted());
    }

    #[Override]
    protected function getEntityClass(): string
    {
        return SoftDeleteableEntity::class;
    }
}
