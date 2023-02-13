<?php

namespace Ivoz\Provider\Application\Service\Locution;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

class LocutionAssembler implements CustomEntityAssemblerInterface
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
        DataTransferObjectInterface $locutionDto,
        EntityInterface $locution,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($locution, LocutionInterface::class);
        $locution->updateFromDto($locutionDto, $fkTransformer);
        $this->handleEntityFiles($locution, $locutionDto, $fkTransformer);
    }
}
