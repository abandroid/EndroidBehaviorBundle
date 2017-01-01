<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Admin\Extension;

use Sonata\AdminBundle\Admin\AdminExtension;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class SortableAdminExtension extends AdminExtension
{
    /**
     * {@inheritdoc}
     */
    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('up', 'string', ['label' => ' ', 'template' => 'BehaviorBundle:Sortable:list_field_up.html.twig'])
            ->add('down', 'string', ['label' => ' ', 'template' => 'BehaviorBundle:Sortable:list_field_down.html.twig'])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureRoutes(AdminInterface $admin, RouteCollection $collection)
    {
        $collection
            ->add('up', $admin->getRouterIdParameter().'/up')
            ->add('down', $admin->getRouterIdParameter().'/down');
    }

    public function createQuery()
    {
    }
}
