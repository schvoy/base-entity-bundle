<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior;

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
