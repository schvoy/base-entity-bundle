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

namespace EightMarq\CoreBundle\Entity\Interfaces\Behavior;

use DateTime;

interface TimestampableInterface
{
    public function getCreatedAt(): DateTime|null;

    public function setCreatedAt(DateTime|null $createdAt): void;

    public function getUpdatedAt(): DateTime|null;

    public function setUpdatedAt(DateTime|null $updatedAt): void;

    public function updateDateTimes(): void;
}
