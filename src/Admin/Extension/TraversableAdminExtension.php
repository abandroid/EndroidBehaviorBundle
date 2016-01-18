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
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Request;

class TraversableAdminExtension extends AdminExtension implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Traversable')
                ->add('parent')
            ->end()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function alterNewInstance(AdminInterface $admin, $object)
    {
        if ($object->getParent() == null) {
            $reflectionClass = $admin->getClass();
            $parent = $this->container->get('doctrine')->getRepository($reflectionClass)->findOneById($this->getRequest()->query->get('parent'));

            $object->setParent($parent);
        }
    }

    /**
     * Returns the current request.
     *
     * @return Request
     */
    protected function getRequest()
    {
        return $this->container->get('request_stack')->getCurrentRequest();
    }
}
