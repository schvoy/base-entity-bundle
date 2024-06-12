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

namespace EightMarq\CoreBundle\Tests\Integration\Entity;

use EightMarq\CoreBundle\Tests\AbstractTestCase;
use EightMarq\CoreBundle\Tests\Fixtures\Entity\IdBasedArticle;
use Override;
use PHPUnit\Framework\Attributes\CoversNothing;

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
