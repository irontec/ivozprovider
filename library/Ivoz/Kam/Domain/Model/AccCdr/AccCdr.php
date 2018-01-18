<?php

namespace Ivoz\Kam\Domain\Model\AccCdr;

/**
 * AccCdr
 */
class AccCdr extends AccCdrAbstract implements AccCdrInterface
{
    use AccCdrTrait;

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
     * @return bool
     */
    public function isBounced()
    {
        if ($this->getBounced() == 'yes') {
            return true;
        }

        return false;
    }

}

