<?php

namespace Ivoz\Kam\Domain\Model\PikeTrusted;

/**
 * PikeTrusted
 */
class PikeTrusted extends PikeTrustedAbstract implements PikeTrustedInterface
{
    use PikeTrustedTrait;

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

