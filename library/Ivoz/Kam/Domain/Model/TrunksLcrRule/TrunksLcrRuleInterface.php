<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TrunksLcrRuleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set lcrId
     *
     * @param integer $lcrId
     *
     * @return self
     */
    public function setLcrId($lcrId);

    /**
     * Get lcrId
     *
     * @return integer
     */
    public function getLcrId();

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return self
     */
    public function setPrefix($prefix = null);

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Set fromUri
     *
     * @param string $fromUri
     *
     * @return self
     */
    public function setFromUri($fromUri = null);

    /**
     * Get fromUri
     *
     * @return string
     */
    public function getFromUri();

    /**
     * Set requestUri
     *
     * @param string $requestUri
     *
     * @return self
     */
    public function setRequestUri($requestUri = null);

    /**
     * Get requestUri
     *
     * @return string
     */
    public function getRequestUri();

    /**
     * Set mtTvalue
     *
     * @param string $mtTvalue
     *
     * @return self
     */
    public function setMtTvalue($mtTvalue = null);

    /**
     * Get mtTvalue
     *
     * @return string
     */
    public function getMtTvalue();

    /**
     * Set stopper
     *
     * @param integer $stopper
     *
     * @return self
     */
    public function setStopper($stopper);

    /**
     * Get stopper
     *
     * @return integer
     */
    public function getStopper();

    /**
     * Set enabled
     *
     * @param integer $enabled
     *
     * @return self
     */
    public function setEnabled($enabled);

    /**
     * Get enabled
     *
     * @return integer
     */
    public function getEnabled();

    /**
     * Set routingPattern
     *
     * @param \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern
     *
     * @return self
     */
    public function setRoutingPattern(\Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface $routingPattern = null);

    /**
     * Get routingPattern
     *
     * @return \Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface
     */
    public function getRoutingPattern();

    /**
     * Set outgoingRouting
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     *
     * @return self
     */
    public function setOutgoingRouting(\Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting = null);

    /**
     * Get outgoingRouting
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface
     */
    public function getOutgoingRouting();

}

