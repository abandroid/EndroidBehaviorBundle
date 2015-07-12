<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\EventListener;

use DateTime;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Endroid\Bundle\BehaviorBundle\Model\TimestampableInterface;

class TimestampableListener
{
    /**
     * Sets create and update timestamp upon persist.
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof TimestampableInterface) {
            if ($entity->getDatetimeCreated() == null) {
                $entity->setDatetimeCreated(new DateTime());
            };
            $entity->setDatetimeUpdated(new DateTime());
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

        if ($entity instanceof TimestampableInterface) {
            $entity->setDatetimeUpdated(new DateTime());
        }
    }
}
