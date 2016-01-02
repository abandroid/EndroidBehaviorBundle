<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;

interface TraversableInterface
{
    /**
     * Sets the parent.
     *
     * @param $parent
     *
     * @return object
     */
    public function setParent(TraversableInterface $parent);

    /**
     * Returns the parent.
     *
     * @return string
     */
    public function getParent();

    /**
     * Returns the path to this entity.
     *
     * @return array
     */
    public function getPath();

    /**
     * Checks if a specific child exists.
     *
     * @param TraversableInterface $child
     *
     * @return bool
     */
    public function hasChild(TraversableInterface $child);

    /**
     * Adds a child.
     *
     * @param $child
     *
     * @return object
     */
    public function addChild(TraversableInterface $child);

    /**
     * Removes a child.
     *
     * @param TraversableInterface $child
     *
     * @return object
     */
    public function removeChild(TraversableInterface $child);

    /**
     * Returns the children.
     *
     * @return ArrayCollection
     */
    public function getChildren();
}
