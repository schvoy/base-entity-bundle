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

use Symfony\Component\Security\Core\User\UserInterface;

interface BlameableInterface
{
    public const CREATED_BY_FIELD = 'createdBy';
    public const UPDATED_BY_FIELD = 'updatedBy';
    public const DELETED_BY_FIELD = 'deletedBy';

    public function getCreatedBy(): ?UserInterface;

    public function setCreatedBy(?UserInterface $createdBy): void;

    public function getUpdatedBy(): ?UserInterface;

    public function setUpdatedBy(?UserInterface $updatedBy): void;

    public function getDeletedBy(): ?UserInterface;

    public function setDeletedBy(?UserInterface $deletedBy): void;
}
