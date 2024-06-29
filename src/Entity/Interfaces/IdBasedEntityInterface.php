<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Interfaces;

interface IdBasedEntityInterface
{
    public function getId(): int|null;

    public function setId(int|null $id): void;
}
