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
    public function getSetid(): int;

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Get weight
     *
     * @return integer
     */
    public function getWeight(): int;

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function getDisabled(): bool;

    /**
     * Get stamp
     *
     * @return \DateTime
     */
    public function getStamp(): \DateTime;

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

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
