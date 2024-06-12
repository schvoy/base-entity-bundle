<?php

/**
 * This file is part of the EightMarq Symfony bundles.
 *
 * (c) Norbert Schvoy <norbert.schvoy@eightmarq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EightMarq\CoreBundle\Entity\Traits\Behavior\SoftDeleteable;

use DateTime;
use EightMarq\CoreBundle\Services\DateTimeProvider;

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
