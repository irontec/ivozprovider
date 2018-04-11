<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

use Assert\Assertion;
use \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
/**
 * Rtpengine
 */
class Rtpengine extends RtpengineAbstract implements RtpengineInterface
{
    use RtpengineTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setMediaRelaySet(MediaRelaySetInterface $mediaRelaySet = null)
    {
        if (!is_null($mediaRelaySet)) {
            $this->setSetid(
                (string) $mediaRelaySet->getId()
            );
        }

        return parent::setMediaRelaySet($mediaRelaySet);
    }
}

