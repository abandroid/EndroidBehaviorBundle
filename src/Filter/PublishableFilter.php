<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Filter;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Filter\SQLFilter;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class PublishableFilter extends SQLFilter implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function addFilterConstraint(ClassMetadata $target, $alias)
    {
        if (!$target->reflClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\PublishableInterface')) {
            return '';
        }

        return $alias.'.published = 1';
    }

    /**
     * Adds the publishable filter and enables it when needed.
     *
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $this->getEntityManager()->getConfiguration()->addFilter('publishable_filter', 'Endroid\Bundle\BehaviorBundle\\Filter\\PublishableFilter');

        if (strpos($this->getRequest()->getPathInfo(), '/admin') === 0) {
            return;
        }

        if (strpos($this->getRequest()->getPathInfo(), '/api') === 0) {
            return;
        }

        $this->getEntityManager()->getFilters()->enable('publishable_filter');
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->container->get('doctrine')->getManager();
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->container->get('request');
    }
}
