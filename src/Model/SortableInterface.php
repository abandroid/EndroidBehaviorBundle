<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

interface SortableInterface
{
    /**
     * Sets the position.
     *
     * @param $position
     *
     * @return mixed
     */
    public function setPosition($position);

    /**
     * Returns the position.
     *
     * @return int
     */
    public function getPosition();
}
