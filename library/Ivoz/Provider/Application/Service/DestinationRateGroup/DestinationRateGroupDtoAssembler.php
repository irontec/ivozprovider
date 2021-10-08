<?php

namespace Ivoz\Provider\Application\Service\DestinationRateGroup;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;

class DestinationRateGroupDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private StoragePathResolverCollection $storagePathResolver
    ) {
    }

    /**
     * @param DestinationRateGroupInterface $destinationRateGroup
     * @throws \Exception
     */
    public function toDto(EntityInterface $destinationRateGroup, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($destinationRateGroup, DestinationRateGroupInterface::class);

        /** @var DestinationRateGroupDto $dto */
        $dto = $destinationRateGroup->toDto($depth);
        $id = $destinationRateGroup->getId();

        if (!$id) {
            return $dto;
        }

        if ($destinationRateGroup->getFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('file');

            $pathResolver
                ->setOriginalFileName(
                    $destinationRateGroup->getFile()->getBaseName()
                );

            $dto->setFilePath(
                $pathResolver->getFilePath($destinationRateGroup)
            );
        }

        return $dto;
    }
}
