<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Interfaces;

use Symfony\Component\Uid\Uuid;

interface UuidBasedEntityInterface
{
    public function getId(): Uuid|null;

    public function setId(Uuid|null $id): void;
}
