<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Interfaces;

use Symfony\Component\Uid\Ulid;

interface UlidBasedEntityInterface
{
    public function getId(): Ulid|null;

    public function setId(Ulid|null $id): void;
}
