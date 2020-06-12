<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface;

class CompanyBalanceService extends AbstractBalanceService implements CompanyBalanceServiceInterface
{
    const ACCOUNT_PREFIX = 'c';

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface::incrementBalance
     * @inheritdoc
     */
    public function incrementBalance(CompanyInterface $company, float $amount)
    {
        return parent::addBalance($company, $amount);
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface::decrementBalance
     * @inheritdoc
     */
    public function decrementBalance(CompanyInterface $company, float $amount)
    {
        return parent::debitBalance($company, $amount);
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceClientInterface::getBalances
     * @inheritdoc
     */
    public function getBalances($brandId, array $companyIds)
    {
        $payload = parent::getAccountsBalances($brandId, $companyIds, self::ACCOUNT_PREFIX);

        $balanceSum = [];
        foreach ($payload->result as $balance) {
            $balanceSum += $this->balanceReducer($balance);
        }
        $payload->result = $balanceSum;

        return $payload;
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceClientInterface::getBalance
     * @inheritdoc
     */
    public function getBalance($brandId, $companyId)
    {
        $payload = parent::getAccountsBalances($brandId, [$companyId], self::ACCOUNT_PREFIX);

        $balanceSum = [];
        foreach ($payload->result as $balance) {
            $balanceSum += $this->balanceReducer($balance);
        }

        if (!array_key_exists($companyId, $balanceSum)) {
            throw new \Exception('Balance not found');
        }

        return $balanceSum[$companyId];
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceClientInterface::getCurrentDayUsage
     * @inheritdoc
     */
    public function getCurrentDayUsage($brandId, $companyId)
    {
        $payload = parent::getAccountsBalances($brandId, [$companyId], self::ACCOUNT_PREFIX);

        $balanceSum = [];
        foreach ($payload->result as $balance) {
            $balanceSum += $this->currentDayUsageReducer($balance);
        }

        return $balanceSum[$companyId];
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceClientInterface::getCurrentDayMaxUsage
     * @inheritdoc
     */
    public function getCurrentDayMaxUsage($brandId, $companyId)
    {
        $payload = parent::getAccountsBalances($brandId, [$companyId], self::ACCOUNT_PREFIX);

        $balanceSum = [];
        foreach ($payload->result as $balance) {
            $balanceSum += $this->currentDayMaxUsageReducer($balance);
        }

        return $balanceSum[$companyId];
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceClientInterface::getAccountStatus
     * @inheritdoc
     */
    public function getAccountStatus($brandId, $companyId)
    {
        $payload = parent::getAccountsBalances($brandId, [$companyId], self::ACCOUNT_PREFIX);

        $balanceSum = [];
        foreach ($payload->result as $balance) {
            $balanceSum += $this->accountStatusReducer($balance);
        }

        return $balanceSum[$companyId];
    }


    /**
     * @param CompanyInterface $entity
     * @return string
     * @throws \InvalidArgumentException
     * @see AbstractBalanceService::getTenant
     */
    protected function getTenant(EntityInterface $entity)
    {
        Assertion::isInstanceOf(
            $entity,
            CompanyInterface::class
        );

        $brand = $entity->getBrand();
        return self::TENANT_PREFIX . $brand->getId();
    }

    /**
     * @see AbstractBalanceService::getAccount
     * @inheritdoc
     */
    protected function getAccount(EntityInterface $entity)
    {
        Assertion::isInstanceOf(
            $entity,
            CompanyInterface::class
        );

        return self::ACCOUNT_PREFIX . $entity->getId();
    }
}
