<?php

namespace Ivoz\Provider\Domain\Assembler\CallCsvReport;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;

class CallCsvReportAssembler implements CustomEntityAssemblerInterface
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
        DataTransferObjectInterface $callCsvReportDto,
        EntityInterface $callCsvReport,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($callCsvReport, CallCsvReportInterface::class);
        $callCsvReport->updateFromDto($callCsvReportDto, $fkTransformer);
        $this->handleEntityFiles($callCsvReport, $callCsvReportDto, $fkTransformer);
    }
}
