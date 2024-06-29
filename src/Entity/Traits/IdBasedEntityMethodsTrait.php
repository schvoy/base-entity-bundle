<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Traits;

trait IdBasedEntityMethodsTrait
{
    public function getId(): int|null
    {
        return $this->id;
    }

    public function setId(int|null $id): void
    {
        $this->id = $id;
    }
}
