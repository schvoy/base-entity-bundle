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
    public const string CREATED_BY_FIELD = 'createdBy';
    public const string UPDATED_BY_FIELD = 'updatedBy';
    public const string DELETED_BY_FIELD = 'deletedBy';

    public function getCreatedBy(): UserInterface|null;

    public function setCreatedBy(UserInterface|null $createdBy): void;

    public function getUpdatedBy(): UserInterface|null;

    public function setUpdatedBy(UserInterface|null $updatedBy): void;

    public function getDeletedBy(): UserInterface|null;

    public function setDeletedBy(UserInterface|null $deletedBy): void;
}
