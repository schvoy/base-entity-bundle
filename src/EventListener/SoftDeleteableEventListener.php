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

namespace EightMarq\CoreBundle\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Events;
use EightMarq\CoreBundle\Entity\Interfaces\Behavior\SoftDeleteableInterface;

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
