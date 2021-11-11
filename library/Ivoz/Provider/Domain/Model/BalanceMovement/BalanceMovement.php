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
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    protected function sanitizeValues(): void
    {
        if ($this->getCarrier()) {
            $this->setCompany(null);
        }
    }
}
