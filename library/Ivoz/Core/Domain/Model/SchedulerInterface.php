<?php

namespace Ivoz\Core\Domain\Model;

/**
 * Entity interface
 *
 * @author Mikel Madariaga <mikel@irontec.com>
 */
interface SchedulerInterface extends EntityInterface
{
    /**
     * Get frequency
     *
     * @return integer
     */
    public function getFrequency();

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit();


    /**
     * @return \DateInterval
     */
    public function getInterval();

    /**
     * Get nextExecution
     *
     * @return \DateTime
     */
    public function getNextExecution();
}
