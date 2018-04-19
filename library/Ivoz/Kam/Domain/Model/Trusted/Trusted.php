<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

/**
 * Trusted
 */
class Trusted extends TrustedAbstract implements TrustedInterface
{
    use TrustedTrait;

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

