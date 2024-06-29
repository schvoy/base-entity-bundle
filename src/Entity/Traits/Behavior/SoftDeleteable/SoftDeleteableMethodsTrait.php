<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Traits\Behavior\SoftDeleteable;

use DateTime;
use Schvoy\BaseEntityBundle\Services\DateTimeProvider;

trait SoftDeleteableMethodsTrait
{
    public function delete(): void
    {
        $this->setDeletedAt(DateTimeProvider::getCurrent());
    }

    public function restore(): void
    {
        $this->setDeletedAt(null);
    }

    public function isDeleted(): bool
    {
        if (null === $this->getDeletedAt()) {
            return false;
        }

        return $this->getDeletedAt() <= DateTimeProvider::getCurrent();
    }

    public function willBeDeleted(DateTime $deletedAt): bool
    {
        if (null === $this->getDeletedAt()) {
            return false;
        }

        return $this->getDeletedAt() <= $deletedAt;
    }

    public function getDeletedAt(): DateTime|null
    {
        return $this->deletedAt;
    }

    public function setDeletedAt(DateTime|null $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }
}
