<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Tests\Integration\Entity\Behavior;

use Override;
use PHPUnit\Framework\Attributes\CoversNothing;
use Schvoy\BaseEntityBundle\Tests\AbstractTestCase;
use Schvoy\BaseEntityBundle\Tests\Fixtures\Entity\Behavior\TimestampableEntity;

#[CoversNothing]
class TimestampableBehaviorTest extends AbstractTestCase
{
    public function testTimestampableBehaviorWhenEntityIsCreatedAndUpdated(): void
    {
        $entity = new TimestampableEntity();

        // Create
        $entity->setValue('Value');

        $this->entityManager->persist($entity);
        $this->flush();

        $id = $entity->getId();
        $this->assertNotNull($id);

        // Fetch after create
        $entity = $this->getEntity($id);

        $originalCreatedAt = $entity->getCreatedAt();
        $originalUpdatedAt = $entity->getUpdatedAt();

        // Update
        $entity = $this->getEntity($id);
        $entity->setValue('Changed value');

        sleep(1);

        $this->flush();

        // Fetch after update
        $entity = $this->getEntity($id);

        $this->assertEquals($originalCreatedAt, $originalUpdatedAt);
        $this->assertEquals($originalCreatedAt, $entity->getCreatedAt());
        $this->assertNotEquals($originalUpdatedAt, $entity->getUpdatedAt());
        $this->assertNotEquals($entity->getCreatedAt(), $entity->getUpdatedAt());
    }

    public function testTimestampableBehaviorWhenEntityIsNotUpdated(): void
    {
        $entity = new TimestampableEntity();

        // Create
        $entity->setValue('Value');

        $this->entityManager->persist($entity);
        $this->flush();

        $id = $entity->getId();
        $this->assertNotNull($id);

        // Fetch after create
        $entity = $this->getEntity($id);

        $originalCreatedAt = $entity->getCreatedAt();
        $originalUpdatedAt = $entity->getUpdatedAt();

        // Update
        $entity = $this->getEntity($id);

        sleep(1);

        $this->entityManager->persist($entity);
        $this->flush();

        // Fetch after update
        $entity = $this->getEntity($id);

        $this->assertEquals($originalCreatedAt, $entity->getCreatedAt());
        $this->assertEquals($originalUpdatedAt, $entity->getUpdatedAt());
    }

    #[Override]
    protected function getEntityClass(): string|bool
    {
        return TimestampableEntity::class;
    }
}
