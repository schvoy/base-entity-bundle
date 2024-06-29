<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Tests\Integration\Entity\Behavior;

use Override;
use PHPUnit\Framework\Attributes\CoversNothing;
use Schvoy\BaseEntityBundle\Tests\AbstractTestCase;
use Schvoy\BaseEntityBundle\Tests\Fixtures\Entity\Behavior\BlameableEntity;

#[CoversNothing]
class BlameableBehaviorTest extends AbstractTestCase
{
    public function testBlameableBehaviorWhenEntityIsCreatedAndUpdated(): void
    {
        $user = $this->loginWithUser();

        $entity = new BlameableEntity();

        // Create
        $entity->setValue('Value');

        $this->entityManager->persist($entity);
        $this->flush();

        $id = $entity->getId();
        $this->assertNotNull($id);

        // Fetch after create
        $entity = $this->getEntity($id);

        $this->assertEquals($user, $entity->getCreatedBy());
        $this->assertEquals($user, $entity->getUpdatedBy());

        // Update
        $newUser = $this->loginWithUser();
        $entity->setValue('Changed value');

        $this->flush();

        // Fetch after update
        $entity = $this->getEntity($id);

        $this->assertEquals($user, $entity->getCreatedBy());
        $this->assertEquals($newUser, $entity->getUpdatedBy());
    }

    public function testBlameableBehaviorWhenEntityIsDeleted(): void
    {
        $user = $this->loginWithUser();

        $entity = new BlameableEntity();

        // Create
        $entity->setValue('Value');

        $this->entityManager->persist($entity);
        $this->flush();

        $id = $entity->getId();
        $this->assertNotNull($id);

        // Fetch after create
        $entity = $this->getEntity($id);

        $this->assertEquals($user, $entity->getCreatedBy());
        $this->assertEquals($user, $entity->getUpdatedBy());

        // Delete
        $newUser = $this->loginWithUser();

        $this->entityManager->remove($entity);
        $this->flush();

        // Fetch after delete
        $entity = $this->getEntity($id);

        $this->assertEquals($user, $entity->getCreatedBy());
        $this->assertEquals($user, $entity->getUpdatedBy());
        $this->assertEquals($newUser, $entity->getDeletedBy());
    }

    #[Override]
    protected function getEntityClass(): string
    {
        return BlameableEntity::class;
    }
}
