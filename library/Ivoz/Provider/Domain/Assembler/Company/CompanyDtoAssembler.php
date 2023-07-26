<?php

namespace Ivoz\Provider\Domain\Assembler\Company;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\CompanyRelCodec\CompanyRelCodecInterface;
use Ivoz\Provider\Domain\Model\CompanyRelGeoIPCountry\CompanyRelGeoIPCountryInterface;
use Ivoz\Provider\Domain\Model\CompanyRelRoutingTag\CompanyRelRoutingTagInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompanyInterface;
use Ivoz\Provider\Domain\Service\Company\CompanyBalanceServiceInterface;

class CompanyDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private CompanyBalanceServiceInterface $companyBalance
    ) {
    }

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

        $domain = $entity->getDomain();
        if ($domain) {
            $dto->setDomainName(
                $domain->getDomain()
            );
        }

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
            ->setCodecIds(
                $codecIds
            );

        if ($context === 'collection') {
            $dto->setCurrencySymbol(
                $entity->getCurrencySymbol()
            );

            $this->setAccountStatus(
                $entity,
                $dto
            );

            $this->setCurrentDayMaxUsage(
                $entity,
                $dto
            );

            $this->setCurrentDayUsage(
                $entity,
                $dto
            );
        }

        return $dto;
    }

    protected function setAccountStatus(CompanyInterface $entity, CompanyDto $dto): void
    {
        try {
            $disabled = $this->companyBalance->getAccountStatus(
                (int) $entity->getBrand()->getId(),
                (int) $entity->getId()
            );

            $status = $disabled
                ? 'Inactive'
                : 'Active';

            $dto->setAccountStatus($status);
        } catch (\Exception $e) {
            $dto->setAccountStatus('Unavailable');
        }
    }

    private function setCurrentDayMaxUsage(CompanyInterface $entity, CompanyDto $dto): void
    {
        try {
            $amount = $this->companyBalance->getCurrentDayMaxUsage(
                (int) $entity->getBrand()->getId(),
                (int) $dto->getId()
            );

            $dto->setCurrentDayMaxUsage((string) $amount);
        } catch (\Exception $e) {
            $dto->setCurrentDayMaxUsage('Unavailable');
        }
    }

    private function setCurrentDayUsage(CompanyInterface $entity, CompanyDto $dto): void
    {
        try {
            $amount = $this->companyBalance->getCurrentDayUsage(
                (int) $entity->getBrand()->getId(),
                (int) $entity->getId()
            );

            if (is_numeric($amount)) {
                $amount = sprintf(
                    '%0.2f',
                    floatval($amount)
                );
            }

            $dto->setCurrentDayUsage(
                floatval($amount)
            );
        } catch (\Exception $e) {
            $dto->setCurrentDayUsage(-1);
        }
    }
}
