<?php

namespace Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Feature\Feature;

class SanitizeBillingMethod implements CompanyLifecycleEventHandlerInterface
{
    public const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private EntityTools $entityTools,
    ) {
    }

    /** @return array<array-key, int> */
    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    public function execute(CompanyInterface $company): void
    {
        // No Billing method, nothing to validate
        if ($company->getBillingMethod() == CompanyInterface::BILLINGMETHOD_NONE) {
            return;
        }

        $brand = $company->getBrand();
        $hasBillingEnabled = $brand->hasFeature(Feature::BILLING);
        // If Brand has no Billing feature enabled, disable Company Billing
        if (!$hasBillingEnabled) {
            /** @var CompanyDto $companyDto */
            $companyDto = $this->entityTools->entityToDto(
                $company
            );
            $companyDto->setBillingMethod(CompanyInterface::BILLINGMETHOD_NONE);
            $this->entityTools->updateEntityByDto(
                $company,
                $companyDto
            );
        }
    }
}
