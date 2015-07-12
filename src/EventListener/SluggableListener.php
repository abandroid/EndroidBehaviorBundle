<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\EventListener;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Endroid\Bundle\BehaviorBundle\Model\SluggableInterface;

class SluggableListener
{
    /**
     * Handles behavior logic before persisting entity.
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof SluggableInterface) {
            $slugify = new Slugify();
            $slug = $slugify->slugify($entity->getSluggable());
            $entity->setSlug($slug);
        }
    }
}
