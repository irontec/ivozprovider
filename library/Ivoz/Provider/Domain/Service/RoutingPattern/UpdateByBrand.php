<?php

namespace Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Service\TrunksLcrRule\UpdateByRoutingPattern;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\RoutingPatternGroup\UpdateByRoutingPatternAndCountry;

class UpdateByBrand implements BrandLifecycleEventHandlerInterface
{
    protected $entityTools;
    protected $countryRepository;
    protected $routingPatternGroupByRoutingPatternAndCountry;

    public function __construct(
        EntityTools $entityTools,
        CountryRepository $countryRepository,
        UpdateByRoutingPatternAndCountry $routingPatternGroupByRoutingPatternAndCountry
    ) {
        $this->entityTools = $entityTools;
        $this->countryRepository = $countryRepository;
        $this->routingPatternGroupByRoutingPatternAndCountry = $routingPatternGroupByRoutingPatternAndCountry;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 20
        ];
    }

    /**
     * @return void
     */
    public function execute(BrandInterface $brand)
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
                ->setDescriptionEs('')
                ->setDescriptionEn('')
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
