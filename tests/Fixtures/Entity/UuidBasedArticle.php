<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Tests\Fixtures\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Schvoy\BaseEntityBundle\Entity\UuidBasedEntity;

#[ORM\Entity]
#[ORM\Table]
class UuidBasedArticle extends UuidBasedEntity
{
    #[ORM\Column(type: Types::STRING)]
    private string $title;

    #[ORM\Column(type: Types::STRING)]
    private string $text;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
