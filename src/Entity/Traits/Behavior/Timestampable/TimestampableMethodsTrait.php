<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Traits\Behavior\Timestampable;

use DateTime;
use Schvoy\BaseEntityBundle\Services\DateTimeProvider;

trait TimestampableMethodsTrait
{
    public function getCreatedAt(): DateTime|null
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime|null $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): DateTime|null
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime|null $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function updateDateTimes(): void
    {
        $currentDate = DateTimeProvider::getCurrent();

        if (null === $this->getCreatedAt()) {
            $this->setCreatedAt($currentDate);
        }

        $this->setUpdatedAt($currentDate);
    }
}
