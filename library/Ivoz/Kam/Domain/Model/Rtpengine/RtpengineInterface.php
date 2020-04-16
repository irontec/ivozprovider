<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Ivoz\Core\Domain\Model\EntityInterface;

interface RtpengineInterface extends EntityInterface
{
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
     * @return \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface | null
     */
    public function getMediaRelaySet();
}
