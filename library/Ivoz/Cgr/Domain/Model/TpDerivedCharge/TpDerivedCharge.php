<?php

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharge;

/**
 * TpDerivedCharge
 */
class TpDerivedCharge extends TpDerivedChargeAbstract implements TpDerivedChargeInterface
{
    use TpDerivedChargeTrait;

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

