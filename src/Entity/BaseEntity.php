<?php

/**
 * This file is part of the Eightmarq Symfony bundles.
 *
 * (c) Norbert Schvoy <norbert.schvoy@eightmarq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EightMarq\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\BlameableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\SoftDeletableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Blameable\BlameableTrait;
use Knp\DoctrineBehaviors\Model\SoftDeletable\SoftDeletableTrait;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\MappedSuperclass()
 */
class BaseEntity implements BaseEntityInterface, TimestampableInterface, BlameableInterface, SoftDeletableInterface
{
    use BaseEntityMethodsTrait;
    use BlameableTrait;
    use SoftDeletableTrait;
    use TimestampableTrait;

    /**
     * @var string|null
     *
     * @ORM\Column(type="guid", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Id()
     */
    protected ?string $id;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }
}