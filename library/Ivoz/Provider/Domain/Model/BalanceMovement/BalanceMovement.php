<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

/**
 * BalanceMovement
 */
class BalanceMovement extends BalanceMovementAbstract implements BalanceMovementInterface
{
    use BalanceMovementTrait;

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

    protected function sanitizeValues()
    {
        if ($this->getCarrier()) {
            $this->setCompany(null);
        }
    }
}
