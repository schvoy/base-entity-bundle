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

        foreach ($unitOfWork->getScheduledEntityDeletions() as $entity) {
            if (!$entity instanceof SoftDeleteableInterface) {
                return;
            }

            $previousDeletedAtValue = $entity->getDeletedAt();

            $entity->delete();
            $objectManager->persist($entity);

            $unitOfWork->propertyChanged(
                $entity,
                SoftDeleteableInterface::DELETED_AT_FIELD,
                $previousDeletedAtValue,
                $entity->getDeletedAt()
            );

            $unitOfWork->scheduleExtraUpdate($entity, [
                SoftDeleteableInterface::DELETED_AT_FIELD => [$previousDeletedAtValue, $entity->getDeletedAt()],
            ]);
        }
    }
}
