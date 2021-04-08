<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;

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

    public function setMediaRelaySet(?MediaRelaySetInterface $mediaRelaySet = null): static;

    public function getSetid(): int;

    public function getUrl(): string;

    public function getWeight(): int;

    public function getDisabled(): bool;

    public function getStamp(): \DateTime;

    public function getDescription(): ?string;

    public function getMediaRelaySet(): ?MediaRelaySetInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;
}
