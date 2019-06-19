<?php

namespace Ivoz\Provider\Application\Service\Invoice;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
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
     * @param integer $depth
     * @return InvoiceDTO
     */
    public function toDto(EntityInterface $entity, $depth = 0, string $context = null)
    {
        Assertion::isInstanceOf($entity, InvoiceInterface::class);

        /** @var InvoiceDTO $dto */
        $dto = $entity->toDto($depth);
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        if ($entity->getPdf()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('Pdf');

            $dto->setPdfPath(
                $pathResolver->getFilePath($entity)
            );
        }

        return $dto;
    }
}
