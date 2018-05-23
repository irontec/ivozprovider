<?php
namespace Ivoz\Provider\Domain\Service\RoutingPattern;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDto;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;
use Ivoz\Provider\Domain\Service\RoutingPatternGroup\UpdateByRoutingPatternAndCountry;

/**
 * Class UpdateByBrand
 * @package Ivoz\Provider\Domain\Service\RoutingPattern
 */
class UpdateByBrand implements BrandLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CountryRepository
     */
    protected $countryRepository;

    /**
     * @var UpdateByRoutingPattern
     */
    protected $routingPatternGroupByRoutingPatternAndCountry;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        CountryRepository $countryRepository,
        UpdateByRoutingPatternAndCountry $routingPatternGroupByRoutingPatternAndCountry
    ) {
        $this->entityPersister = $entityPersister;
        $this->countryRepository = $countryRepository;
        $this->routingPatternGroupByRoutingPatternAndCountry = $routingPatternGroupByRoutingPatternAndCountry;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 20
        ];
    }

    public function execute(BrandInterface $entity, $isNew)
    {
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
                ->setRegExp((string) $country->getCountryCode())
                ->setBrandId($entity->getId());

            $routingPattern = $this->entityPersister->persistDto(
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