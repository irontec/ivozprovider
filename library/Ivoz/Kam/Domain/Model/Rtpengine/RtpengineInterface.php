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
    public function getChangeSet(): array;

    public function setMediaRelaySet(?MediaRelaySetInterface $mediaRelaySet = null): static;

    public function getSetid(): int;

    public function getUrl(): string;

    public function getWeight(): int;

    public function getDisabled(): bool;

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getStamp(): \DateTimeInterface;

    public function getDescription(): ?string;

    public function getMediaRelaySet(): ?MediaRelaySetInterface;

    public function isInitialized(): bool;
}
