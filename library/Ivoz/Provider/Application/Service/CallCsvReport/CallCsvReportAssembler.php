<?php

namespace Ivoz\Provider\Application\Service\CallCsvReport;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;
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
