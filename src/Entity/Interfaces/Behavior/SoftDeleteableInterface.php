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

interface SoftDeleteableInterface
{
    public const string DELETED_AT_FIELD = 'deletedAt';

    public function delete(): void;

    public function restore(): void;

    public function isDeleted(): bool;

    public function willBeDeleted(DateTime $deletedAt): bool;

    public function getDeletedAt(): DateTime|null;

    public function setDeletedAt(DateTime|null $deletedAt): void;
}
