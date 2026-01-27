<?php

namespace Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

class UnlinkDdi
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public function execute(DdiInterface $ddi): DdiInterface
    {
        $country = $ddi->getCountry();
        if (!$country) {
            throw new \DomainException('Cannot unlink DDI: country is required');
        }

        $countryId = $country->getId();
        $ddiNumber = $ddi->getDdi();
        $type = $ddi->getType();
        $brandId = $ddi->getBrand()->getId();
        $description = $ddi->getDescription();
        $useDdiProviderRoutingTag = $ddi->getUseDdiProviderRoutingTag();
        $ddiProvider = $ddi->getDdiProvider();
        $ddiProviderId = $ddiProvider?->getId();
        $routingTag = $ddi->getRoutingTag();
        $routingTagId = $routingTag?->getId();

        $this->entityTools->remove($ddi);

        $newDdiDto = new DdiDto();
        $newDdiDto
            ->setDdi($ddiNumber)
            ->setCountryId($countryId)
            ->setBrandId($brandId)
            ->setType($type)
            ->setDescription($description)
            ->setUseDdiProviderRoutingTag($useDdiProviderRoutingTag)
            ->setCompanyId(null)
            ->setDdiProviderId($ddiProviderId)
            ->setRoutingTagId($routingTagId);

        /** @var DdiInterface $newDdi */
        $newDdi = $this->entityTools->persistDto(
            $newDdiDto
        );

        return $newDdi;
    }
}
