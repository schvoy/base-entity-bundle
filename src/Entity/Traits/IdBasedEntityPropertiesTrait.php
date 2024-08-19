<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Traits;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait IdBasedEntityPropertiesTrait
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected int|null $id = null;
}
