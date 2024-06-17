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

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use EightMarq\CoreBundle\Entity\Interfaces\Behavior\BlameableInterface;
use EightMarq\CoreBundle\Entity\Interfaces\Behavior\SoftDeleteableInterface;
use EightMarq\CoreBundle\Entity\Interfaces\Behavior\TimestampableInterface;
use EightMarq\CoreBundle\Entity\Interfaces\IdBasedEntityInterface;
use EightMarq\CoreBundle\Entity\Traits\Behavior\Blameable\BlameableTrait;
use EightMarq\CoreBundle\Entity\Traits\Behavior\SoftDeleteable\SoftDeleteableTrait;
use EightMarq\CoreBundle\Entity\Traits\Behavior\Timestampable\TimestampableTrait;
use EightMarq\CoreBundle\Entity\Traits\IdBasedEntityMethodsTrait;

#[ORM\MappedSuperclass]
class IdBasedEntity implements IdBasedEntityInterface, TimestampableInterface, BlameableInterface, SoftDeleteableInterface
{
    use IdBasedEntityMethodsTrait;
    use BlameableTrait;
    use SoftDeleteableTrait;
    use TimestampableTrait;

    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int|null $id = null;
}
