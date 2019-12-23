<?php

namespace Ivoz\Provider\Application\Service\Invoice;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;
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
