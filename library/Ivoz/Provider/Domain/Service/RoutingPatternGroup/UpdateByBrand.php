<?php
namespace Ivoz\Provider\Domain\Service\RoutingPatternGroup;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupDTO;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroup;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\RoutingPatternGroup\RoutingPatternGroupRepository;
use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternDTO;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternDTO;
use Ivoz\Provider\Domain\Service\Brand\BrandLifecycleEventHandlerInterface;

/**
 * Class UpdateByBrand
 * @package Ivoz\Provider\Domain\Service\RoutingPatternGroup
 * @lifecycle post_persist
 */
class UpdateByBrand implements BrandLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var RoutingPatternGroupRepository
     */
    protected $routingPatternGroupRepository;

    /**
     * @var CountryRepository
     */
    protected $countryRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        RoutingPatternGroupRepository $routingPatternGroupRepository,
        CountryRepository $countryRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->routingPatternGroupRepository = $routingPatternGroupRepository;
        $this->countryRepository = $countryRepository;
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
            $routingPatternDto = RoutingPattern::createDTO();
            $routingPatternDto
                ->setNameEs($country->getName()->getEs())
                ->setNameEn($country->getName()->getEn())
                ->setDescriptionEs('')
                ->setDescriptionEn('')
                ->setRegExp((string) $country->getCallingCode())
                ->setBrandId($entity->getId());

            $routingPattern = $this->entityPersister->persistDto(
                $routingPatternDto,
                null,
                true
            );

            if (!$country->getZone()) {
                /**
                 * @todo Every country has a value on db. Is this even required?
                 */
                continue;
            }

            $routingPatternGroup = $this->routingPatternGroupRepository->findOneBy([
                'brand' => $entity->getId(),
                'name' => $country->getZone()->getEn()
            ]);

            if (empty($routingPatternGroup)) {

                /**
                 * @var RoutingPatternGroupDto $routingPatternGroupDto
                 */
                $routingPatternGroupDto = RoutingPatternGroup::createDTO();
                $routingPatternGroupDto
                    ->setName($country->getZone()->getEn())
                    ->setBrandId($entity->getId());

                $routingPatternGroup = $this->entityPersister->persistDto(
                    $routingPatternGroupDto,
                    null,
                    true
                );
            }

            /**
             * @var RoutingPatternGroupsRelPatternDTO $routingPatternGroupsRelPatternDto
             */
            $routingPatternGroupsRelPatternDto = RoutingPatternGroupsRelPattern::createDTO();
            $routingPatternGroupsRelPatternDto
                ->setRoutingPatternId($routingPattern->getId())
                ->setRoutingPatternGroupid($routingPatternGroup->getId());

            $this->entityPersister->persistDto($routingPatternGroupsRelPatternDto);
        }
    }
}