<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Traits\Behavior\SoftDeleteable;

trait SoftDeleteableTrait
{
    use SoftDeleteablePropertiesTrait;
    use SoftDeleteableMethodsTrait;
}
