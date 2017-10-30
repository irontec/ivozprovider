<?php

namespace Ivoz\Ast\Domain\Model\Musiconhold;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface MusiconholdInterface extends LoggableEntityInterface
{
    public function getChangeSet();

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Set mode
     *
     * @param string $mode
     *
     * @return self
     */
    public function setMode($mode = null);

    /**
     * Get mode
     *
     * @return string
     */
    public function getMode();

    /**
     * Set directory
     *
     * @param string $directory
     *
     * @return self
     */
    public function setDirectory($directory = null);

    /**
     * Get directory
     *
     * @return string
     */
    public function getDirectory();

    /**
     * Set application
     *
     * @param string $application
     *
     * @return self
     */
    public function setApplication($application = null);

    /**
     * Get application
     *
     * @return string
     */
    public function getApplication();

    /**
     * Set digit
     *
     * @param string $digit
     *
     * @return self
     */
    public function setDigit($digit = null);

    /**
     * Get digit
     *
     * @return string
     */
    public function getDigit();

    /**
     * Set sort
     *
     * @param string $sort
     *
     * @return self
     */
    public function setSort($sort = null);

    /**
     * Get sort
     *
     * @return string
     */
    public function getSort();

    /**
     * Set format
     *
     * @param string $format
     *
     * @return self
     */
    public function setFormat($format = null);

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat();

    /**
     * Set stamp
     *
     * @param \DateTime $stamp
     *
     * @return self
     */
    public function setStamp($stamp = null);

    /**
     * Get stamp
     *
     * @return \DateTime
     */
    public function getStamp();

}

