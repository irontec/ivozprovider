<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Doctrine\Common\Collections\Criteria;

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

}

