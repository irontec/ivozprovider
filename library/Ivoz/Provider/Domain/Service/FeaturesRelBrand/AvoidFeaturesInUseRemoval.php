<?php

namespace Ivoz\Provider\Domain\Service\FeaturesRelBrand;

use DomainException;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrandInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyRepository;

class AvoidFeaturesInUseRemoval implements FeaturesRelBrandLifecycleEventHandlerInterface
{
    public const PRE_REMOVE_PRIORITY = self::PRIORITY_HIGH;

    public function __construct(
        private FeaturesRelCompanyRepository $featuresRelCompanyRepository,
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
    public function execute(FeaturesRelBrandInterface $relBrand): void
    {
        $brand = $relBrand->getBrand();
        $feature = $relBrand->getFeature();
        if (!$brand) {
            return;
        }

        $isFeatureInUse = $this->featuresRelCompanyRepository
            ->isFeatureInUseByBrandId(
                (int) $brand->getId(),
                (int) $feature->getId()
            );

        if ($isFeatureInUse) {
            throw new \DomainException('Cannot remove a feature used by brand companies.');
        }
    }
}
