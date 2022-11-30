<?php

namespace Ivoz\Provider\Application\Service\Domain;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

class DomainDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private BrandRepository $brandRepository,
        private CompanyRepository $companyRepository
    ) {
    }

    /**
     * @param DomainInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, DomainInterface::class);
        $dto = $entity->toDto($depth);

        $brand = $this
            ->brandRepository
            ->findOneByDomain(
                (string) $dto->getDomain()
            );

        if (!is_null($brand)) {
            $dto
                ->setBrandName(
                    $brand->getName()
                );
        }

        $company = $this
            ->companyRepository
            ->findOneByDomain(
                (string)  $dto->getDomain()
            );

        if (!is_null($company)) {
            $dto
                ->setCompanyName(
                    $company->getName()
                );
        }

        return $dto;
    }
}
