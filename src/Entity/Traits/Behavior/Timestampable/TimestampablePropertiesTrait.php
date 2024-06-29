<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Timestampable;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait TimestampablePropertiesTrait
{
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    protected DateTime|null $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    protected DateTime|null $updatedAt = null;
}
