<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Ivoz\Core\Domain\Model\EntityInterface;

interface TpTimingInterface extends EntityInterface
{
    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    public function setTpid($tpid);

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid();

    /**
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    public function setTag($tag = null);

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag();

    /**
     * Set years
     *
     * @param string $years
     *
     * @return self
     */
    public function setYears($years);

    /**
     * Get years
     *
     * @return string
     */
    public function getYears();

    /**
     * Set months
     *
     * @param string $months
     *
     * @return self
     */
    public function setMonths($months);

    /**
     * Get months
     *
     * @return string
     */
    public function getMonths();

    /**
     * Set monthDays
     *
     * @param string $monthDays
     *
     * @return self
     */
    public function setMonthDays($monthDays);

    /**
     * Get monthDays
     *
     * @return string
     */
    public function getMonthDays();

    /**
     * Set weekDays
     *
     * @param string $weekDays
     *
     * @return self
     */
    public function setWeekDays($weekDays);

    /**
     * Get weekDays
     *
     * @return string
     */
    public function getWeekDays();

    /**
     * Set time
     *
     * @param string $time
     *
     * @return self
     */
    public function setTime($time);

    /**
     * Get time
     *
     * @return string
     */
    public function getTime();

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt);

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt();

}

