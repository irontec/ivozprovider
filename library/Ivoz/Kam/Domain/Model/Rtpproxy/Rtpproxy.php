<?php

namespace Ivoz\Kam\Domain\Model\Rtpproxy;

use Assert\Assertion;

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
}

