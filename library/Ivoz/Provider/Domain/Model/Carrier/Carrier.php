<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

/**
 * Carrier
 */
class Carrier extends CarrierAbstract implements CarrierInterface
{
    use CarrierTrait;

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

