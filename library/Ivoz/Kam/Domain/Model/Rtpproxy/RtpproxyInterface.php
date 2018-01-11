<?php

namespace Ivoz\Kam\Domain\Model\Rtpproxy;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface RtpproxyInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setMediaRelaySet(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySet = null);

    /**
     * Set setid
     *
     * @param string $setid
     *
     * @return self
     */
    public function setSetid($setid);

    /**
     * Get setid
     *
     * @return string
     */
    public function getSetid();

    /**
     * Set url
     *
     * @param string $url
     *
     * @return self
     */
    public function setUrl($url);

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl();

    /**
     * Set flags
     *
     * @param integer $flags
     *
     * @return self
     */
    public function setFlags($flags);

    /**
     * Get flags
     *
     * @return integer
     */
    public function getFlags();

    /**
     * Set weight
     *
     * @param integer $weight
     *
     * @return self
     */
    public function setWeight($weight);

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description = null);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get mediaRelaySet
     *
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface
     */
    public function getMediaRelaySet();

}

