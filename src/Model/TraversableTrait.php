<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

trait TraversableTrait
{
    /**
     * @ORM\ManyToOne(targetEntity="Object", inversedBy="children", cascade={"persist"})
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Object", mappedBy="parent", cascade={"persist"}, orphanRemoval=true)
     */
    protected $children;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * Sets the parent.
     *
     * @param $parent
     *
     * @return object
     */
    public function setParent(TraversableInterface $parent)
    {
        $this->parent = $parent;

        if (!$parent->hasChild($this)) {
            $parent->addChild($this);
        }

        return $this->parent;
    }

    /**
     * Returns the parent.
     *
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Returns the path to this entity.
     *
     * @return array
     */
    public function getPath()
    {
        $path = array();
        if ($this->parent != null) {
            $path = $this->parent->getPath();
        }
        $path[] = $this;

        return $path;
    }

    /**
     * Checks if a specific child exists.
     *
     * @param TraversableInterface $child
     *
     * @return bool
     */
    public function hasChild(TraversableInterface $child)
    {
        return $this->children->contains($child);
    }

    /**
     * Adds a child.
     *
     * @param $child
     *
     * @return object
     */
    public function addChild(TraversableInterface $child)
    {
        $this->children->add($child);

        if ($child->getParent() != $this) {
            $child->setParent($this);
        }

        return $this;
    }

    /**
     * Removes a child.
     *
     * @param TraversableInterface $child
     *
     * @return object
     */
    public function removeChild(TraversableInterface $child)
    {
        $this->children->removeElement($child);

        if ($child->getParent() == $this) {
            $child->setParent(null);
        }

        return $this;
    }

    /**
     * Returns the children.
     *
     * @return ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }
}
