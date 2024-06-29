<?php

declare(strict_types=1);

namespace Schvoy\BaseEntityBundle\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Schvoy\BaseEntityBundle\Entity\Interfaces\Behavior\TimestampableInterface;

#[AsDoctrineListener(event: Events::loadClassMetadata)]
final class TimestampableEventListener
{
    public function loadClassMetadata(LoadClassMetadataEventArgs $loadClassMetadataEventArgs): void
    {
        $classMetadata = $loadClassMetadataEventArgs->getClassMetadata();

        if (null === $classMetadata->reflClass) {
            // Class has not yet been fully built, ignore this event
            return;
        }

        if (!is_a($classMetadata->reflClass->getName(), TimestampableInterface::class, true)) {
            return;
        }

        if ($classMetadata->isMappedSuperclass) {
            return;
        }

        $classMetadata->addLifecycleCallback('updateDateTimes', Events::prePersist);
        $classMetadata->addLifecycleCallback('updateDateTimes', Events::preUpdate);
    }
}
