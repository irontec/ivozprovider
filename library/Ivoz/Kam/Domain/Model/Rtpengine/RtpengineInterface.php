<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* RtpengineInterface
*/
interface RtpengineInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    public function setMediaRelaySet(?MediaRelaySetInterface $mediaRelaySet = null): RtpengineInterface;

    /**
     * Get setid
     *
     * @return int
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
     * @return int
     */
    public function getWeight(): int;

    /**
     * Get disabled
     *
     * @return bool
     */
    public function getDisabled(): bool;

    /**
     * Get stamp
     *
     * @return \DateTimeInterface
     */
    public function getStamp(): \DateTimeInterface;

    /**
     * Get description
     *
     * @return string | null
     */
    public function getDescription(): ?string;

    /**
     * Get mediaRelaySet
     *
     * @return MediaRelaySetInterface | null
     */
    public function getMediaRelaySet(): ?MediaRelaySetInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
