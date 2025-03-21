<?php

namespace Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\RoutingPatternGroup\UpdateByRoutingPatternAndCountry;

class UpdateByBrand implements BrandLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools,
        private CountryRepository $countryRepository,
        private UpdateByRoutingPatternAndCountry $routingPatternGroupByRoutingPatternAndCountry
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 20
        ];
    }

    public function execute(BrandInterface $brand): void
    {
        $isNew = $brand->isNew();
        if (!$isNew) {
            return;
        }
        $countries = $this->countryRepository->findAll();

        /**
         * @var Country $country
         */
        foreach ($countries as $country) {

            /**
             * @var RoutingPatternDTO $routingPattern
             */
            $routingPatternDto = RoutingPattern::createDto();
            $routingPatternDto
                ->setNameEs($country->getName()->getEs())
                ->setNameEn($country->getName()->getEn())
                ->setNameCa($country->getName()->getCa())
                ->setNameIt($country->getName()->getIt())
                ->setDescriptionEs('')
                ->setDescriptionEn('')
                ->setDescriptionCa('')
                ->setDescriptionIt('')
                ->setPrefix((string) $country->getCountryCode())
                ->setBrandId($brand->getId());

            /** @var RoutingPatternInterface $routingPattern */
            $routingPattern = $this->entityTools->persistDto(
                $routingPatternDto,
                null,
                true
            );

            $this->routingPatternGroupByRoutingPatternAndCountry->execute(
                $routingPattern,
                $country
            );
        }
    }
}
