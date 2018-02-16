<?php

namespace Ivoz\Kam\Domain\Model\Rtpproxy;

use Assert\Assertion;
use \Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
/**
 * Rtpproxy
 */
class Rtpproxy extends RtpproxyAbstract implements RtpproxyInterface
{
    use RtpproxyTrait;

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

