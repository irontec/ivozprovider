<?php

namespace Ivoz\Provider\Application\Service\Invoice;

use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;

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
