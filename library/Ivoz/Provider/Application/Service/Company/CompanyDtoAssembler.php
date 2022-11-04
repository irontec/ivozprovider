<?php

namespace Ivoz\Provider\Application\Service\Company;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface;
use Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryInterface;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface;

class CompanyDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param CompanyInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, CompanyInterface::class);

        $dto = $entity->toDto($depth);

        $featureIds = array_map(
            function (FeaturesRelCompanyInterface $relFeature) {
                return (int)$relFeature
                    ->getFeature()
                    ->getId();
            },
            $entity->getRelFeatures()
        );

        $geoIpAllowedCountryIds = array_map(
            function (CompanyRelGeoIPCountryInterface $relCountry) {
                return (int)$relCountry
                    ->getCountry()
                    ->getId();
            },
            $entity->getRelCountries()
        );

        $routingTagIds = array_map(
            function (CompanyRelRoutingTagInterface $relRoutingTag) {
                return (int)$relRoutingTag
                    ->getRoutingTag()
                    ->getId();
            },
            $entity->getRelRoutingTags()
        );

        $codecIds = array_map(
            function (CompanyRelCodecInterface $relRelCodec) {
                return (int)$relRelCodec
                    ->getCodec()
                    ->getId();
            },
            $entity->getRelCodecs()
        );

        $dto
            ->setFeatureIds(
                $featureIds
            )
            ->setGeoIpAllowedCountries(
                $geoIpAllowedCountryIds
            )
            ->setRoutingTagIds(
                $routingTagIds
            )
            ->setRoutingTagIds(
                $codecIds
            );

        return $dto;
    }
}
