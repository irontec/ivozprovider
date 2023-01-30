<?php

namespace Ivoz\Provider\Domain\Service\FeaturesRelBrand;

use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Feature\Feature;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface;

class AvoidBillingRemoval implements FeaturesRelBrandLifecycleEventHandlerInterface
{
    public const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private CompanyRepository $companyRepository,
    ) {
    }

    /** @return array<array-key, int> */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY
        ];
    }

    /**
     * @throws \DomainException
     */
    public function execute(FeaturesRelBrandInterface $featuresRelBrand): void
    {
        $brand = $featuresRelBrand->getBrand();
        $feature = $featuresRelBrand->getFeature();
        if (!$brand) {
            return;
        }

        if ($feature->getId() == Feature::BILLING) {
            $billingEnabledCompanyIds = $this->companyRepository->getBillingEnabledCompanyIdsByBrand(
                (int) $brand->getId()
            );
            // Avoid Billing feature removal if there are companies with Billing method enabled
            if (!empty($billingEnabledCompanyIds)) {
                throw new \DomainException("Feature can not be removed. Update all Companies billing method first.");
            }
        }
    }
}
