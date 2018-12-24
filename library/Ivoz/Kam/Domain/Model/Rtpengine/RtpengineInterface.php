<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface RtpengineInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setMediaRelaySet(\Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface $mediaRelaySet = null);

    /**
     * Get setid
     *
     * @return integer
     */
    public function getSetid();

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl();

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight();

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function getDisabled();

    /**
     * Get stamp
     *
     * @return \DateTime
     */
    public function getStamp();

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription();

    /**
     * Get mediaRelaySet
     *
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface
     */
    public function getMediaRelaySet();
}
