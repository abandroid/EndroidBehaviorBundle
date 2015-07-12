<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\EventListener;

use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use ReflectionClass;

class TranslatableListener
{
    /**
     * Sets target entity classes upon class meta data load.
     *
     * @param LoadClassMetadataEventArgs $args
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        /** @var ClassMetadata $classMetadata */
        $classMetadata = $args->getClassMetadata();
        $reflectionClass = new ReflectionClass($classMetadata->getName());

        // Set correct target entities
        if ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TranslationInterface')) {
            $classMetadata->associationMappings['translatable']['targetEntity'] = $classMetadata->getName().'Translatable';
        } elseif ($reflectionClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TranslatableInterface')) {
            $classMetadata->associationMappings['translations']['targetEntity'] = str_replace('Translatable', '', $classMetadata->getName());
        }
    }
}
