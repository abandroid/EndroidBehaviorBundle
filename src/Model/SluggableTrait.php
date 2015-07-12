<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

trait SluggableTrait
{
    /**
     * @ORM\Column(length=128)
     */
    protected $slug;

    /**
     * Sets the slug.
     *
     * @param $slug
     *
     * @return SluggableInterface
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Returns the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Returns the sluggable.
     *
     * @return string
     */
    public function getSluggable()
    {
        return strval($this);
    }
}
