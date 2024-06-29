<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\BlameableInterface;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\SoftDeleteableInterface;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\TimestampableInterface;
use Schvoy\BaseEntityBundle\Entity\Interfaces\UlidBasedEntityInterface;
use Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Blameable\BlameableTrait;
use Schvoy\BaseEntityBundle\Entity\Traits\Behavior\SoftDeleteable\SoftDeleteableTrait;
use Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Timestampable\TimestampableTrait;
use Schvoy\BaseEntityBundle\Entity\Traits\UlidBasedEntityMethodsTrait;
use Symfony\Bridge\Doctrine\Types\UlidType;
use Symfony\Component\Uid\Ulid;

#[ORM\MappedSuperclass]
class UlidBasedEntity implements UlidBasedEntityInterface, TimestampableInterface, BlameableInterface, SoftDeleteableInterface
{
    use UlidBasedEntityMethodsTrait;
    use BlameableTrait;
    use SoftDeleteableTrait;
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\Column(type: UlidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.ulid_generator')]
    protected Ulid $id;
}
