<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\EventListener;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use ReflectionClass;

class TraversableListener
{
    /**
     * Sets target entity classes upon class meta data load.
     *
     * @param LoadClassMetadataEventArgs $args
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        $classMetadata = $args->getClassMetadata();
        $reflectionClass = new ReflectionClass($classMetadata->getName());

        // Set correct target entities
        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TraversableInterface')) {
            $classMetadata->associationMappings['parent']['targetEntity'] = $classMetadata->getName();
            $classMetadata->associationMappings['children']['targetEntity'] = $classMetadata->getName();

            // In case of sortable order children by position
            if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\SortableInterface')) {
                $classMetadata->associationMappings['children']['orderBy'] = ['position' => 'ASC'];
            }
        }
    }
}
