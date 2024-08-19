<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\BlameableInterface;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\SoftDeleteableInterface;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\TimestampableInterface;
use Schvoy\BaseEntityBundle\Entity\Interfaces\IdBasedEntityInterface;
use Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Blameable\BlameableTrait;
use Schvoy\BaseEntityBundle\Entity\Traits\Behavior\SoftDeleteable\SoftDeleteableTrait;
use Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Timestampable\TimestampableTrait;
use Schvoy\BaseEntityBundle\Entity\Traits\IdBasedEntityTrait;

#[ORM\MappedSuperclass]
class IdBasedEntity implements IdBasedEntityInterface, TimestampableInterface, BlameableInterface, SoftDeleteableInterface
{
    use IdBasedEntityTrait;
    use BlameableTrait;
    use SoftDeleteableTrait;
    use TimestampableTrait;
}
