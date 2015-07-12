<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Endroid\Bundle\BehaviorBundle\Model\SortableInterface;

class SortableListener
{
    /**
     * Sets position upon persist.
     *
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $manager = $args->getEntityManager();

        if ($entity instanceof SortableInterface) {
            if ($entity->getPosition() == null) {
                $entity->setPosition($entity->getId());
                $manager->persist($entity);
                $manager->flush();
            };
        }
    }

    /**
     * Sets update timestamp upon update.
     *
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $manager = $args->getEntityManager();
        $repository = $manager->getRepository(get_class($entity));

        if ($entity instanceof SortableInterface) {
            $originalEntity = $repository->findOneById($entity->getId());
            if ($entity->getPosition() == null) {
                $entity->setPosition($entity->getId());
            } elseif ($originalEntity->getPosition() != $entity->getPosition()) {
                $swapEntity = $repository->findOneByPosition($entity->getPosition());
                $swapEntity->setPosition($originalEntity->getPosition());
                $manager->persist($swapEntity);
                $manager->flush();
            }
        }
    }
}
