<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\SoftDeleteableInterface;

#[AsDoctrineListener(event: Events::onFlush)]
final class SoftDeleteableEventListener
{
    public function onFlush(OnFlushEventArgs $onFlushEventArgs): void
    {
        $objectManager = $onFlushEventArgs->getObjectManager();
        $unitOfWork = $objectManager->getUnitOfWork();

        foreach ($unitOfWork->getScheduledEntityDeletions() as $object) {
            if (!$object instanceof SoftDeleteableInterface) {
                return;
            }

            $previousDeletedAtValue = $object->getDeletedAt();

            $object->delete();
            $objectManager->persist($object);

            $unitOfWork->propertyChanged(
                $object,
                SoftDeleteableInterface::DELETED_AT_FIELD,
                $previousDeletedAtValue,
                $object->getDeletedAt()
            );

            $unitOfWork->scheduleExtraUpdate($object, [
                SoftDeleteableInterface::DELETED_AT_FIELD => [$previousDeletedAtValue, $object->getDeletedAt()],
            ]);
        }
    }
}
