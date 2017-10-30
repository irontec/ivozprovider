<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface FaxesInOutInterface extends LoggableEntityInterface
{
    public function getChangeSet();

    /**
     * Set calldate
     *
     * @param \DateTime $calldate
     *
     * @return self
     */
    public function setCalldate($calldate);

    /**
     * Get calldate
     *
     * @return \DateTime
     */
    public function getCalldate();

    /**
     * Set src
     *
     * @param string $src
     *
     * @return self
     */
    public function setSrc($src = null);

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc();

    /**
     * Set dst
     *
     * @param string $dst
     *
     * @return self
     */
    public function setDst($dst = null);

    /**
     * Get dst
     *
     * @return string
     */
    public function getDst();

    /**
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type = null);

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Set pages
     *
     * @param string $pages
     *
     * @return self
     */
    public function setPages($pages = null);

    /**
     * Get pages
     *
     * @return string
     */
    public function getPages();

    /**
     * Set status
     *
     * @param string $status
     *
     * @return self
     */
    public function setStatus($status = null);

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set fax
     *
     * @param \Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax
     *
     * @return self
     */
    public function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax);

    /**
     * Get fax
     *
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxInterface
     */
    public function getFax();

    /**
     * Set file
     *
     * @param \Ivoz\Provider\Domain\Model\FaxesInOut\File $file
     *
     * @return self
     */
    public function setFile(\Ivoz\Provider\Domain\Model\FaxesInOut\File $file);

    /**
     * Get file
     *
     * @return \Ivoz\Provider\Domain\Model\FaxesInOut\File
     */
    public function getFile();

}

