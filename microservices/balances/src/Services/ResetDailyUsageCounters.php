<?php

namespace Services;

use Ivoz\Cgr\Infrastructure\Cgrates\Service\EnableAccountService;
use Ivoz\Cgr\Infrastructure\Cgrates\Service\ReassembleTriggerService;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;

class ResetDailyUsageCounters
{
    private $reassembleTriggerService;
    private $enableAccountService;
    private $brandRepository;

    public function __construct(
        ReassembleTriggerService $reassembleTriggerService,
        EnableAccountService $enableAccountService,
        BrandRepository $brandRepository
    ) {
        $this->reassembleTriggerService = $reassembleTriggerService;
        $this->enableAccountService = $enableAccountService;
        $this->brandRepository = $brandRepository;
    }

    /**
     * @return void
     */
    public function execute()
    {
        /** @var BrandInterface[] $brands */
        $brands = $this->brandRepository->findAll();
        foreach ($brands as $brand) {
            $companies = $brand->getCompanies();
            foreach ($companies as $company) {
                $tenant = $brand->getCgrTenant();
                $account = $company->getCgrSubject();

                $this->reassembleTriggerService->execute(
                    $tenant,
                    $account,
                    true
                );

                $this->enableAccountService->execute(
                    $tenant,
                    $account
                );
            }
        }
    }
}
