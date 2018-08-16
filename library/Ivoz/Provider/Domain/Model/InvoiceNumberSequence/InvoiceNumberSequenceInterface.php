<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface InvoiceNumberSequenceInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Fake/Empty setter
     *
     * Version value is automatically handled by doctrine
     *
     * @inheritdoc
     */
    public function setVersion($version);

    /**
     * Update and return latest value
     *
     * @return string
     */
    public function nextval();

    /**
     * @deprecated
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
     * @deprecated
     * Set prefix
     *
     * @param string $prefix
     *
     * @return self
     */
    public function setPrefix($prefix);

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix();

    /**
     * @deprecated
     * Set sequenceLength
     *
     * @param integer $sequenceLength
     *
     * @return self
     */
    public function setSequenceLength($sequenceLength);

    /**
     * Get sequenceLength
     *
     * @return integer
     */
    public function getSequenceLength();

    /**
     * @deprecated
     * Set increment
     *
     * @param integer $increment
     *
     * @return self
     */
    public function setIncrement($increment);

    /**
     * Get increment
     *
     * @return integer
     */
    public function getIncrement();

    /**
     * @deprecated
     * Set latestValue
     *
     * @param string $latestValue
     *
     * @return self
     */
    public function setLatestValue($latestValue = null);

    /**
     * Get latestValue
     *
     * @return string
     */
    public function getLatestValue();

    /**
     * @deprecated
     * Set iteration
     *
     * @param integer $iteration
     *
     * @return self
     */
    public function setIteration($iteration);

    /**
     * Get iteration
     *
     * @return integer
     */
    public function getIteration();

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion();

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand);

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand();

}

