<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Cgrates;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface;

class CarrierBalanceService extends AbstractBalanceService implements CarrierBalanceServiceInterface
{
    const ACCOUNT_PREFIX = 'cr';

    /**
     * @see \Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface::incrementBalance
     * @inheritdoc
     */
    public function incrementBalance(CarrierInterface $company, float $amount)
    {
        return parent::addBalance($company, $amount);
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceInterface::decrementBalance
     * @inheritdoc
     */
    public function decrementBalance(CarrierInterface $company, float $amount)
    {
        return parent::debitBalance($company, $amount);
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceClientInterface::getBalances
     * @inheritdoc
     */
    public function getBalances($brandId, array $carrierIds)
    {
        $tenant = self::TENANT_PREFIX . $brandId;
        $accountIds = array_map(
            function ($carrierId) {
                return self::ACCOUNT_PREFIX . $carrierId;
            },
            $carrierIds
        );

        return parent::getAccountsBalances($tenant, $accountIds);
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Carrier\CarrierBalanceServiceClientInterface::getBalance
     * @inheritdoc
     */
    public function getBalance($brandId, $carrierId)
    {
        $carrierIds = [$carrierId];
        $payload = $this->getBalances($brandId, $carrierIds);

        return $payload->result[$carrierId];
    }

    /**
     * @see AbstractBalanceService::getTenant
     * @inheritdoc
     */
    protected function getTenant(EntityInterface $entity)
    {
        Assertion::isInstanceOf(
            $entity,
            CarrierInterface::class
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
            CarrierInterface::class
        );

        return self::ACCOUNT_PREFIX . $entity->getId();
    }
}
