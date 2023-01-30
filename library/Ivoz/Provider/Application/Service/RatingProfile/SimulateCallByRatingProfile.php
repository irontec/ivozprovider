<?php

namespace Ivoz\Provider\Application\Service\RatingProfile;

use Ivoz\Cgr\Infrastructure\Cgrates\Service\BillingService;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Currency\CurrencyDto;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\TarificationInfo;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileInterface;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfileRepository;

class SimulateCallByRatingProfile
{
    public function __construct(
        private BillingService $billingService,
        private RatingProfileRepository $ratingProfileRepository
    ) {
    }

    public function execute(
        BrandInterface $brand,
        int $duration,
        string $phoneNumber,
        int $ratingProfileId
    ): TarificationInfo {
        if ($duration < 1) {
            $duration = 60;
        }

        if ($phoneNumber[0] !== '+') {
            throw new \DomainException('Phone number must be in E.164 format (prefixed by "+" symbol)');
        }


        /** @var ?RatingProfileInterface $ratingProfile */
        $ratingProfile = $this
            ->ratingProfileRepository
            ->find($ratingProfileId);

        if (is_null($ratingProfile)) {
            throw new \DomainException('Rating Profile not found', 404);
        }

        $company =  $ratingProfile->getCompany();
        if (is_null($company)) {
            throw new \DomainException('Company not found', 404);
        }

        $subject = $company->getCgrSubject();
        $brandTenant = $brand->getCgrTenant();

        /** @var CurrencyInterface $currency */
        $currency = $ratingProfile
            ->getRatingPlanGroup()
            ->getCurrency();

        return $this->simulateCall(
            $duration,
            $brandTenant,
            $subject,
            $phoneNumber,
            $currency
        );
    }

    protected function simulateCall(int $duration, string $brandTenant, string $subject, string $phone, CurrencyInterface $currency): TarificationInfo
    {
        try {
            $simulatedCall = $this
                ->billingService
                ->simulateCallByRatingProfile(
                    $brandTenant,
                    $subject,
                    $phone,
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
