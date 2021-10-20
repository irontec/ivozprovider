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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    public function setMediaRelaySet(?MediaRelaySetInterface $mediaRelaySet = null): static
    {
        if (!is_null($mediaRelaySet)) {
            $this->setSetid(
                $mediaRelaySet->getId()
            );
        }

        return parent::setMediaRelaySet($mediaRelaySet);
    }
}
