<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Tests\Integration\Entity;

use Override;
use PHPUnit\Framework\Attributes\CoversNothing;
use Schvoy\BaseEntityBundle\Tests\AbstractTestCase;
use Schvoy\BaseEntityBundle\Tests\Fixtures\Entity\UlidBasedArticle;
use Symfony\Component\Uid\Ulid;

#[CoversNothing]
class UlidBasedEntityTest extends AbstractTestCase
{
    public function testIdBasedEntity(): void
    {
        $entity = new UlidBasedArticle();
        $entity->setTitle('Title');
        $entity->setText('Text of the article');

        $this->entityManager->persist($entity);
        $this->flush();

        $id = $entity->getId();
        $this->assertNotNull($id);
        $this->assertEquals(Ulid::class, get_class($entity->getId()));

        // Fetch
        $entity = $this->getEntity($id);

        $this->assertEquals('Title', $entity->getTitle());
        $this->assertEquals('Text of the article', $entity->getText());

        // Update
        $entity->setText('New changed text of the article');

        $this->flush();

        // Fetch after update
        $entity = $this->getEntity($id);

        $this->assertEquals('New changed text of the article', $entity->getText());

        // Remove
        $this->entityManager->remove($entity);
        $this->flush();

        // Fetch after remove
        $entity = $this->getEntity($id);

        $this->assertNotNull($entity->getDeletedAt());
    }

    #[Override]
    protected function getEntityClass(): string|bool
    {
        return UlidBasedArticle::class;
    }
}
