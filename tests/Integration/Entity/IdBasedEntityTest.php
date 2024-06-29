<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Tests\Integration\Entity;

use Override;
use PHPUnit\Framework\Attributes\CoversNothing;
use Schvoy\BaseEntityBundle\Tests\AbstractTestCase;
use Schvoy\BaseEntityBundle\Tests\Fixtures\Entity\IdBasedArticle;

#[CoversNothing]
class IdBasedEntityTest extends AbstractTestCase
{
    public function testIdBasedEntity(): void
    {
        $entity = new IdBasedArticle();
        $entity->setTitle('Title');
        $entity->setText('Text of the article');

        $this->entityManager->persist($entity);
        $this->flush();

        $id = $entity->getId();
        $this->assertNotNull($id);
        $this->assertEquals(1, $id);

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
    protected function getEntityClass(): string
    {
        return IdBasedArticle::class;
    }
}
