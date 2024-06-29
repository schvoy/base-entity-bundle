<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Traits;

use Symfony\Component\Uid\Ulid;

trait UlidBasedEntityMethodsTrait
{
    public function getId(): Ulid|null
    {
        return $this->id;
    }

    public function setId(Ulid|null $id): void
    {
        $this->id = $id;
    }
}
