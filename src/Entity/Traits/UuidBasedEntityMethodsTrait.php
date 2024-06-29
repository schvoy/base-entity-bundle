<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Traits;

use Symfony\Component\Uid\Uuid;

trait UuidBasedEntityMethodsTrait
{
    public function getId(): Uuid|null
    {
        return $this->id;
    }

    public function setId(Uuid|null $id): void
    {
        $this->id = $id;
    }
}
