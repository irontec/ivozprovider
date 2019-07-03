<?php

namespace Ivoz\Provider\Application\Service\CallCsvReport;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;

class CallCsvReportAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    public function fromDto(
        DataTransferObjectInterface $callCsvReportDto,
        EntityInterface $callCsvReport,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($callCsvReport, CallCsvReportInterface::class);
        $callCsvReport->updateFromDto($callCsvReportDto, $fkTransformer);
        $this->handleEntityFiles($callCsvReport, $callCsvReportDto, $fkTransformer);
    }
}
