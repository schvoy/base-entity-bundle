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

namespace EightMarq\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EightMarq\CoreBundle\Entity\Interfaces\Behavior\SoftDeleteableInterface;
use EightMarq\CoreBundle\Entity\Interfaces\Behavior\TimestampableInterface;
use EightMarq\CoreBundle\Entity\Interfaces\UuidBasedEntityInterface;
use EightMarq\CoreBundle\Entity\Traits\Behavior\SoftDeleteable\SoftDeleteableTrait;
use EightMarq\CoreBundle\Entity\Traits\Behavior\Timestampable\TimestampableTrait;
use EightMarq\CoreBundle\Entity\Traits\UuidBasedEntityMethodsTrait;
use Knp\DoctrineBehaviors\Contract\Entity\BlameableInterface;
use Knp\DoctrineBehaviors\Model\Blameable\BlameableTrait;
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
