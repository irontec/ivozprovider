<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

interface CompanyBalanceServiceInterface
{
    /**
     * @param CompanyInterface $company
     * @param float $amount
     * @return array
     */
    public function incrementBalance(CompanyInterface $company, float $amount);

    /**
     * @param CompanyInterface $company
     * @param float $amount
     * @return array
     */
    public function decrementBalance(CompanyInterface $company, float $amount);

    /**
     * @param int $brandId
     * @param array $companyIds
     * @return \stdClass
     */
    public function getBalances(int $brandId, array $companyIds);

    /**
     * @param int $brandId
     * @param int $companyId
     * @return mixed
     */
    public function getBalance(int $brandId, int $companyId);

    /**
     * @param int $brandId
     * @param int $companyId
     * @return mixed
     */
    public function getCurrentDayUsage(int $brandId, int $companyId);

    /**
     * @param int $brandId
     * @param int $companyId
     * @return mixed
     */
    public function getCurrentDayMaxUsage(int $brandId, int $companyId);


    /**
     * @return boolean
     */
    public function getAccountStatus(int $brandId, int $companyId);
}
