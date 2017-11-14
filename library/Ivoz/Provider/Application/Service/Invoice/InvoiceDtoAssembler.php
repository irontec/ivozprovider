<?php

namespace Ivoz\Provider\Application\Service\Invoice;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDTO;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Assert\Assertion;

class InvoiceDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @var StoragePathResolverCollection
     */
    protected $storagePathResolver;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    /**
     * @param InvoiceInterface $entity
     * @return InvoiceDTO
     */
    public function toDTO(EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, InvoiceInterface::class);

        /** @var InvoiceDTO $dto */
        $dto = $entity->toDTO();
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        if ($entity->getLogo()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('Pdf');

            $dto->setLogoPath(
                $pathResolver->getFilePath($entity)
            );
        }

        return $dto;
    }
}