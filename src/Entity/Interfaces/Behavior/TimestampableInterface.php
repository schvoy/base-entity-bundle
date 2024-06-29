<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior;

use DateTime;

interface TimestampableInterface
{
    public function getCreatedAt(): DateTime|null;

    public function setCreatedAt(DateTime|null $createdAt): void;

    public function getUpdatedAt(): DateTime|null;

    public function setUpdatedAt(DateTime|null $updatedAt): void;

    public function updateDateTimes(): void;
}
