<?php

namespace Ivoz\Provider\Application\Service\Invoice;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

class InvoiceDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private StoragePathResolverCollection $storagePathResolver
    ) {
    }

    /**
     * @param InvoiceInterface $invoice
     * @throws \Exception
     */
    public function toDto(EntityInterface $invoice, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($invoice, InvoiceInterface::class);

        $dto = $invoice->toDto($depth);
        $id = $invoice->getId();

        if (!$id) {
            return $dto;
        }

        $currency = $invoice
                ->getCompany()
                ->getCurrencySymbol();

        $dto->setCurrency(
            $currency
        );

        if ($invoice->getPdf()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('Pdf');

            $dto->setPdfPath(
                $pathResolver->getFilePath($invoice)
            );
        }

        return $dto;
    }
}
