<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\UnitOfWork;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\BlameableInterface;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\SoftDeleteableInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;

#[AsDoctrineListener(event: Events::prePersist)]
#[AsDoctrineListener(event: Events::preRemove)]
#[AsDoctrineListener(event: Events::preUpdate)]
final class BlameableEventListener
{
    public function __construct(private readonly Security $security)
    {
    }

    public function prePersist(PrePersistEventArgs $prePersistEventArgs): void
    {
        $unitOfWork = $this->getUnitOfWork($prePersistEventArgs);

        $object = $prePersistEventArgs->getObject();

        if (!$object instanceof BlameableInterface) {
            return;
        }

        $user = $this->security->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        if (null === $object->getCreatedBy()) {
            $object->setCreatedBy($user);

            $unitOfWork->propertyChanged($object, BlameableInterface::CREATED_BY_FIELD, null, $user);
        }

        if (null === $object->getUpdatedBy()) {
            $object->setUpdatedBy($user);

            $unitOfWork->propertyChanged($object, BlameableInterface::UPDATED_BY_FIELD, null, $user);
        }
    }

    public function preUpdate(PreUpdateEventArgs $preUpdateEventArgs): void
    {
        $unitOfWork = $this->getUnitOfWork($preUpdateEventArgs);

        $object = $preUpdateEventArgs->getObject();

        if (!$object instanceof BlameableInterface) {
            return;
        }

        $user = $this->security->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $previousUpdatedByValue = $object->getUpdatedBy();

        $object->setUpdatedBy($user);

        $unitOfWork->propertyChanged($object, BlameableInterface::UPDATED_BY_FIELD, $previousUpdatedByValue, $user);
    }

    public function preRemove(PreRemoveEventArgs $preRemoveEventArgs): void
    {
        $unitOfWork = $this->getUnitOfWork($preRemoveEventArgs);

        $object = $preRemoveEventArgs->getObject();

        if (!$object instanceof BlameableInterface || !$object instanceof SoftDeleteableInterface) {
            return;
        }

        $user = $this->security->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $previousDeletedByValue = $object->getDeletedBy();

        $object->setDeletedBy($user);

        $unitOfWork->propertyChanged($object, BlameableInterface::DELETED_BY_FIELD, $previousDeletedByValue, $user);
    }

    private function getUnitOfWork(LifecycleEventArgs $lifecycleEventArgs): UnitOfWork
    {
        $objectManager = $lifecycleEventArgs->getObjectManager();

        return $objectManager->getUnitOfWork();
    }
}
