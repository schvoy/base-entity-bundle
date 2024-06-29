<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Tests\Fixtures\Entity\Behavior;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Schvoy\BaseEntityBundle\Entity\IdBasedEntity;

#[ORM\Entity]
#[ORM\Table]
class SoftDeleteableEntity extends IdBasedEntity
{
    #[ORM\Column(type: Types::STRING)]
    private string $value;

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}
