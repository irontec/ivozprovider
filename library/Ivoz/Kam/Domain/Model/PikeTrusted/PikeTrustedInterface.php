<?php

namespace Ivoz\Kam\Domain\Model\PikeTrusted;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface PikeTrustedInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set srcIp
     *
     * @param string $srcIp
     *
     * @return self
     */
    public function setSrcIp($srcIp = null);

    /**
     * Get srcIp
     *
     * @return string
     */
    public function getSrcIp();

    /**
     * Set proto
     *
     * @param string $proto
     *
     * @return self
     */
    public function setProto($proto = null);

    /**
     * Get proto
     *
     * @return string
     */
    public function getProto();

    /**
     * Set fromPattern
     *
     * @param string $fromPattern
     *
     * @return self
     */
    public function setFromPattern($fromPattern = null);

    /**
     * Get fromPattern
     *
     * @return string
     */
    public function getFromPattern();

    /**
     * Set ruriPattern
     *
     * @param string $ruriPattern
     *
     * @return self
     */
    public function setRuriPattern($ruriPattern = null);

    /**
     * Get ruriPattern
     *
     * @return string
     */
    public function getRuriPattern();

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
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority);

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

}

