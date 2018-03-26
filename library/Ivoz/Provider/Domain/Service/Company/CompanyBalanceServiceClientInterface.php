<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

interface CompanyBalanceServiceClientInterface
{
    /**
     * @param CompanyInterface $company
     * @param float $amount
     * @return array
     */
    public function incrementBalance(CompanyInterface $company, float $amount);

    /**
     * @param $brandId
     * @param array $companyIds
     * @return \stdClass
     */
    public function getBalances($brandId, array $companyIds);
}