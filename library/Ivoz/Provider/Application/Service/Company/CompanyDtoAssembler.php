<?php

namespace Ivoz\Provider\Application\Service\Company;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany;

class CompanyDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param CompanyInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, CompanyInterface::class);

        /** @var CompanyDto $dto */
        $dto = $entity->toDto($depth);

        $domain = $entity->getDomain();
        if ($domain) {
            $dto->setDomainName(
                (string) $domain->getDomain()
            );
        }

        if (in_array($context, CompanyDto::CONTEXTS_WITH_FEATURES, true)) {
            $featureIds = array_map(
                function (FeaturesRelCompany $relFeature) {
                    return $relFeature
                        ->getFeature()
                        ->getId();
                },
                $entity->getRelFeatures()
            );

            $dto->setFeatureIds(
                $featureIds
            );
        }

        return $dto;
    }
}
