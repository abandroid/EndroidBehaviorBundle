<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

interface PublishableInterface
{
    /**
     * Sets the published status.
     *
     * @param $published
     *
     * @return mixed
     */
    public function setPublished($published);

    /**
     * Returns the published status.
     *
     * @return string
     */
    public function getPublished();
}
