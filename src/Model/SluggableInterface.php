<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

interface SluggableInterface
{
    /**
     * Sets the slug.
     *
     * @param $slug
     *
     * @return $this
     */
    public function setSlug($slug);

    /**
     * Returns the slug.
     *
     * @return mixed
     */
    public function getSlug();

    /**
     * Returns the sluggable.
     *
     * @return string
     */
    public function getSluggable();
}
