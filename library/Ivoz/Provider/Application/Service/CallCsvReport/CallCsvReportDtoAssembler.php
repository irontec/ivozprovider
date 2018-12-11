<?php

namespace Ivoz\Provider\Application\Service\CallCsvReport;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportDto;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportInterface;
use Assert\Assertion;

class CallCsvReportDtoAssembler implements CustomDtoAssemblerInterface
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
     * @param CallCsvReportInterface $entity
     * @param integer $depth
     * @return CallCsvReportDTO
     */
    public function toDto(EntityInterface $entity, $depth = 0)
    {
        /** @var CallCsvReportInterface $entity */
        Assertion::isInstanceOf($entity, CallCsvReportInterface::class);

        /** @var CallCsvReportDTO $dto */
        $dto = $entity->toDto($depth);
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        if (!is_null($entity->getCsv()->getFileSize())) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('Csv');

            $dto->setCsvPath(
                $pathResolver->getFilePath($entity)
            );
        }

        return $dto;
    }
}
