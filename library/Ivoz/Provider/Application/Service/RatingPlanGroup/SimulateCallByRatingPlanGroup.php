<?php

namespace Ivoz\Provider\Application\Service\RatingPlanGroup;

use Ivoz\Cgr\Infrastructure\Cgrates\Service\BillingService;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroupRepository;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\TarificationInfo;

class SimulateCallByRatingPlanGroup
{
    public function __construct(
        private RatingPlanGroupRepository $ratingPlanGroupRepository,
        private BillingService $billingService
    ) {
    }

    public function execute(
        BrandInterface $brand,
        int $duration,
        string $phoneNumber,
        int $ratingPlanGroupId
    ): TarificationInfo {

        if ($duration < 1) {
            $duration = 60;
        }

        if ($phoneNumber[0] !== '+') {
            throw new \DomainException('Phone number must be in E.164 format (prefixed by "+" symbol)');
        }

        /** @var ?RatingPlanGroupInterface $ratingPlanGroup */
        $ratingPlanGroup = $this
            ->ratingPlanGroupRepository
            ->find($ratingPlanGroupId);

        if (!$ratingPlanGroup) {
            throw new \DomainException('Rating plan group not found', 404);
        }

        $currency = $ratingPlanGroup->getCurrency();

        if (!$currency) {
            throw new \DomainException('Currency not found', 404);
        }

        $cgrTag = $ratingPlanGroup->getCgrTag();
        $brandTenant = $brand->getCgrTenant();

        return $this->simulateCall(
            $duration,
            $brandTenant,
            $cgrTag,
            $phoneNumber,
            $currency
        );
    }

    protected function simulateCall(int $duration, string $brandTenant, string $cgrTag, string $number, CurrencyInterface $currency): TarificationInfo
    {
        try {
            $simulatedCall = $this
                ->billingService
                ->simulateCallByRatingPlan(
                    $brandTenant,
                    $cgrTag,
                    $number,
                    $duration
                );

            return TarificationInfo::fromSimulatedCall(
                $simulatedCall,
                $currency->getSymbol()
            );
        } catch (\Exception $e) {
            throw new \DomainException('Unexpected error: ' . $e->getMessage());
        }
    }
}
