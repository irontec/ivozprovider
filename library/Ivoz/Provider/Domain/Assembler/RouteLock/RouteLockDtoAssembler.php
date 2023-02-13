<?php

namespace Ivoz\Provider\Domain\Assembler\RouteLock;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceRepository;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockDto;
use Ivoz\Provider\Domain\Model\RouteLock\RouteLockInterface;

class RouteLockDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private CompanyServiceRepository $companyServiceRepository
    ) {
    }

    /**
     * @param RouteLockInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, RouteLockInterface::class);

        $dto = $entity->toDto($depth);

        /**
         * @var CompanyService[] $companyServices
         */
        $companyServices = $this->companyServiceRepository->findBy([
            'company' => $entity->getCompany()->getId()
        ]);

        // Get Recording number for this locution
        foreach ($companyServices as $companyService) {
            $service = $companyService->getService();
            $extension = '*' . $companyService->getCode() . $entity->getId();

            switch ($service->getIden()) {
                case 'OpenLock':
                    $dto->setOpenExtension($extension);
                    break;
                case 'CloseLock':
                    $dto->setCloseExtension($extension);
                    break;
                case 'ToggleLock':
                    $dto->setToggleExtension($extension);
                    break;
            }
        }

        return $dto;
    }
}
