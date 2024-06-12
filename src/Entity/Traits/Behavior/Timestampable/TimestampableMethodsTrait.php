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

namespace EightMarq\CoreBundle\Entity\Traits\Behavior\Timestampable;

use DateTime;
use EightMarq\CoreBundle\Services\DateTimeProvider;

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
