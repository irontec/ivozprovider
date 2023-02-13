<?php

namespace Ivoz\Provider\Domain\Assembler\Invoice;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;

class InvoiceAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    /**
     * @return void
     */
    public function fromDto(
        DataTransferObjectInterface $invoiceDto,
        EntityInterface $invoice,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($invoice, InvoiceInterface::class);
        $invoice->updateFromDto($invoiceDto, $fkTransformer);
        $this->handleEntityFiles($invoice, $invoiceDto, $fkTransformer);
    }
}
