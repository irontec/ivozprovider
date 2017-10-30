<?php

namespace Ivoz\Kam\Domain\Model\PikeTrusted;

/**
 * PikeTrusted
 */
class PikeTrusted extends PikeTrustedAbstract implements PikeTrustedInterface
{
    use PikeTrustedTrait;

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

