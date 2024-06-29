<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\BlameableInterface;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\SoftDeleteableInterface;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\TimestampableInterface;
use Schvoy\BaseEntityBundle\Entity\Interfaces\UuidBasedEntityInterface;
use Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Blameable\BlameableTrait;
use Schvoy\BaseEntityBundle\Entity\Traits\Behavior\SoftDeleteable\SoftDeleteableTrait;
use Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Timestampable\TimestampableTrait;
use Schvoy\BaseEntityBundle\Entity\Traits\UuidBasedEntityMethodsTrait;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\MappedSuperclass]
class UuidBasedEntity implements UuidBasedEntityInterface, TimestampableInterface, BlameableInterface, SoftDeleteableInterface
{
    use UuidBasedEntityMethodsTrait;
    use BlameableTrait;
    use SoftDeleteableTrait;
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    protected Uuid $id;
}
