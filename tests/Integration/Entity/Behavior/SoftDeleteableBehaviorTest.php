<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Tests\Integration\Entity\Behavior;

use DateTime;
use Override;
use PHPUnit\Framework\Attributes\CoversNothing;
use Schvoy\BaseEntityBundle\Tests\AbstractTestCase;
use Schvoy\BaseEntityBundle\Tests\Fixtures\Entity\Behavior\SoftDeleteableEntity;

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
    protected function getEntityClass(): string|bool
    {
        return SoftDeleteableEntity::class;
    }
}
