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

class TranslatableFilter extends SQLFilter implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function addFilterConstraint(ClassMetadata $target, $alias)
    {
        if (!$target->reflClass->implementsInterface('Endroid\Bundle\BehaviorBundle\Model\TranslationInterface')) {
            return '';
        }

        return $alias.'.locale = '.$this->getParameter('locale');
    }

    /**
     * Adds the translatable filter and enables it when needed.
     *
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $this->getEntityManager()->getConfiguration()->addFilter('translatable_filter', 'Endroid\Bundle\BehaviorBundle\\Filter\\TranslatableFilter');

        if (strpos($this->getRequest()->getPathInfo(), '/admin') === 0) {
            return;
        }

        if (strpos($this->getRequest()->getPathInfo(), '/api') === 0) {
            return;
        }

        $filter = $this->getEntityManager()->getFilters()->enable('translatable_filter');
        $filter->setParameter('locale', $this->container->get('request')->getLocale());
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
