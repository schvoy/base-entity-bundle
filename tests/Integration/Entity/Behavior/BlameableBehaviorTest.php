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

use EightMarq\CoreBundle\Tests\AbstractTestCase;
use EightMarq\CoreBundle\Tests\Fixtures\Entity\Behavior\BlameableEntity;
use Override;
use PHPUnit\Framework\Attributes\CoversNothing;

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
