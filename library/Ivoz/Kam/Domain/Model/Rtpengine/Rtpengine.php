<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;

/**
 * Rtpengine
 */
class Rtpengine extends RtpengineAbstract implements RtpengineInterface
{
    use RtpengineTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    public function setMediaRelaySet(?MediaRelaySetInterface $mediaRelaySet = null): static
    {
        if (!is_null($mediaRelaySet)) {
            $this->setSetid(
                (int) $mediaRelaySet->getId()
            );
        }

        return parent::setMediaRelaySet($mediaRelaySet);
    }
}
