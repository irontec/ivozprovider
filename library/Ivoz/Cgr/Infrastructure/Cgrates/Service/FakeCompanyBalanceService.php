<?php

namespace Ivoz\Cgr\Infrastructure\Cgrates\Service;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class FakeCompanyBalanceService extends CompanyBalanceService
{
    private float $balance = 0;

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface::incrementBalance
     * @inheritdoc
     * @return array<string, boolean|null>
     */
    public function incrementBalance(CompanyInterface $company, float $amount): array
    {
        $this->balance = $company->getBalance() + $amount;

        return [
            'success' => true,
            'error' => null,
        ];
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface::decrementBalance
     * @inheritdoc
     * @return array<string, boolean|null>
     */
    public function decrementBalance(CompanyInterface $company, float $amount): array
    {
        $this->balance = $company->getBalance() - $amount;

        return [
            'success' => true,
            'error' => null,
        ];
    }

    /**
     * @param array<int> $companyIds
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface::getBalances
     * @inheritdoc
     */
    public function getBalances(int $brandId, array $companyIds)
    {
        $response = new \stdClass();

        $response->error = null;
        $response->result = [];

        foreach ($companyIds as $companyId) {
            $response->result[$companyId] = $this->balance;
        }

        return $response;
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface::getBalance
     * @inheritdoc
     */
    public function getBalance(int $brandId, int $companyId)
    {
        return $this->balance;
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface::getCurrentDayUsage
     * @inheritdoc
     */
    public function getCurrentDayUsage(int $brandId, int $companyId)
    {
        throw new \Exception('TODO');
    }

    /**
     * @see \Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface::getCurrentDayMaxUsage
     * @inheritdoc
     */
    public function getCurrentDayMaxUsage(int $brandId, int $companyId)
    {
        throw new \Exception('TODO');
    }
}
