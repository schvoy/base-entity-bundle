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

use EightMarq\CoreBundle\Tests\Fixtures\Entity\IdBasedArticle;
use EightMarq\CoreBundle\Tests\Fixtures\Entity\UlidBasedArticle;
use EightMarq\CoreBundle\Tests\Fixtures\Entity\UuidBasedArticle;
use PHPUnit\Framework\Attributes\CoversNothing;
use Symfony\Component\Uid\Ulid;
use Symfony\Component\Uid\UuidV7;

#[CoversNothing]
class BaseEntitiesTest extends AbstractTestCase
{
    public function testIdBasedCreateEntity(): void
    {
        // Create
        $article = new IdBasedArticle();
        $article->setTitle('Title');
        $article->setText('Text of the article');

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        $this->assertNotNull($article->getId());
        $this->assertEquals(1, $article->getId());

        $this->checkEntityLifeCycle(IdBasedArticle::class, $article->getId());
    }

    public function testUlidBasedCreateEntity(): void
    {
        $article = new UlidBasedArticle();
        $article->setTitle('Title');
        $article->setText('Text of the article');

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        $this->assertNotNull($article->getId());
        $this->assertEquals(Ulid::class, get_class($article->getId()));

        $this->checkEntityLifeCycle(UlidBasedArticle::class, $article->getId());
    }

    public function testUuidBasedCreateEntity(): void
    {
        $article = new UuidBasedArticle();
        $article->setTitle('Title');
        $article->setText('Text of the article');

        $this->entityManager->persist($article);
        $this->entityManager->flush();

        $this->assertNotNull($article->getId());
        $this->assertEquals(UuidV7::class, get_class($article->getId()));

        $this->checkEntityLifeCycle(UuidBasedArticle::class, $article->getId());
    }

    private function checkEntityLifeCycle(string $entity, int|UuidV7|Ulid|null $id): void
    {
        $repository = $this->entityManager->getRepository($entity);

        // Fetch
        $article = $repository->find($id);

        $this->assertEquals('Title', $article->getTitle());
        $this->assertEquals('Text of the article', $article->getText());

        // Update
        $article->setText('New changed text of the article');

        $this->entityManager->flush();

        // Fetch again
        $article = $repository->find($id);

        $this->assertEquals('New changed text of the article', $article->getText());

        // Remove
        $this->entityManager->remove($article);
        $this->entityManager->flush();

        // Fetch last time
        $article = $repository->find($id);

        $this->assertNull($article);
    }
}
