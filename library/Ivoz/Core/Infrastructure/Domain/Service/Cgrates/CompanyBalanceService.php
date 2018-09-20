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
        $tenant = self::TENANT_PREFIX . $brandId;
        $accountIds = array_map(
            function ($companyId) {
                return self::ACCOUNT_PREFIX . $companyId;
            },
            $companyIds
        );

        return parent::getAccountsBalances($tenant, $accountIds);
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceClientInterface::getBalance
     * @inheritdoc
     */
    public function getBalance($brandId, $companyId)
    {
        $companyIds = [$companyId];
        $payload = $this->getBalances($brandId, $companyIds);

        return $payload->result[$companyId];
    }

    /**
     * @see AbstractBalanceService::getTenant
     * @inheritdoc
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
