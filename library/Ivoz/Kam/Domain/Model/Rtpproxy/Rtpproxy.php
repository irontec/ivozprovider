<?php

namespace Ivoz\Kam\Domain\Model\Rtpproxy;

/**
 * Rtpproxy
 */
class Rtpproxy extends RtpproxyAbstract implements RtpproxyInterface
{
    use RtpproxyTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

