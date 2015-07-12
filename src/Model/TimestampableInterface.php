<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

use DateTime;

interface TimestampableInterface
{
    /**
     * Sets the date and time of creation.
     *
     * @param $datetimeCreated
     *
     * @return mixed
     */
    public function setDatetimeCreated(DateTime $datetimeCreated);

    /**
     * Returns the date and time of creation.
     *
     * @return DateTime
     */
    public function getDatetimeCreated();

    /**
     * Sets the date and time of update.
     *
     * @param $datetimeUpdated
     *
     * @return mixed
     */
    public function setDatetimeUpdated(DateTime $datetimeUpdated);

    /**
     * Returns the date and time of update.
     *
     * @return DateTime
     */
    public function getDatetimeUpdated();
}
