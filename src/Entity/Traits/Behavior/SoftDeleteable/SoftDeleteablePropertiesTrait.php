<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Traits\Behavior\SoftDeleteable;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait SoftDeleteablePropertiesTrait
{
    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    protected DateTime|null $deletedAt = null;
}
