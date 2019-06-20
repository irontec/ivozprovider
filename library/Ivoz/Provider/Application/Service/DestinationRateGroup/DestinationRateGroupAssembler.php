<?php

namespace Ivoz\Provider\Application\Service\DestinationRateGroup;

use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;

class DestinationRateGroupAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    public function fromDto(
        DataTransferObjectInterface $destinationRateGroupDto,
        EntityInterface $destinationRateGroup,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($destinationRateGroup, DestinationRateGroupInterface::class);
        $destinationRateGroup->updateFromDto($destinationRateGroupDto, $fkTransformer);
        $this->handleEntityFiles($destinationRateGroup, $destinationRateGroupDto, $fkTransformer);
    }
}
