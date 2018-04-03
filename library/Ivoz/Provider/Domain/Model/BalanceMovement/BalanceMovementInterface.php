<?php

namespace Ivoz\Provider\Domain\Model\BalanceMovement;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface BalanceMovementInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Set amount
     *
     * @param string $amount
     *
     * @return self
     */
    public function setAmount($amount = null);

    /**
     * Get amount
     *
     * @return string
     */
    public function getAmount();

    /**
     * Set balance
     *
     * @param string $balance
     *
     * @return self
     */
    public function setBalance($balance = null);

    /**
     * Get balance
     *
     * @return string
     */
    public function getBalance();

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     *
     * @return self
     */
    public function setCreatedOn($createdOn = null);

    /**
     * Get createdOn
     *
     * @return \DateTime
     */
    public function getCreatedOn();

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company);

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

}

