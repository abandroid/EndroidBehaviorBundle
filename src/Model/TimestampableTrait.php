<?php

/*
 * (c) Jeroen van den Enden <info@endroid.nl>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Endroid\Bundle\BehaviorBundle\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait TimestampableTrait
{
    /**
     * @ORM\Column(type="datetime")
     */
    protected $datetimeCreated;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $datetimeUpdated;

    /**
     * Sets the date and time of creation.
     *
     * @param $datetimeCreated
     *
     * @return mixed
     */
    public function setDatetimeCreated(DateTime $datetimeCreated)
    {
        $this->datetimeCreated = $datetimeCreated;

        return $this;
    }

    /**
     * Returns the date and time of creation.
     *
     * @return DateTime
     */
    public function getDatetimeCreated()
    {
        return $this->datetimeCreated;
    }

    /**
     * Sets the date and time of update.
     *
     * @param $datetimeUpdated
     *
     * @return mixed
     */
    public function setDatetimeUpdated(DateTime $datetimeUpdated)
    {
        $this->datetimeUpdated = $datetimeUpdated;

        return $this;
    }

    /**
     * Returns the date and time of update.
     *
     * @return DateTime
     */
    public function getDatetimeUpdated()
    {
        return $this->datetimeUpdated;
    }
}
