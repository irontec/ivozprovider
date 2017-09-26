<?php

namespace Ivoz\Kam\Domain\Model\PikeTrusted;

/**
 * PikeTrusted
 */
class PikeTrusted extends PikeTrustedAbstract implements PikeTrustedInterface
{
    use PikeTrustedTrait;

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

