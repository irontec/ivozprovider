<?php

namespace Ivoz\Provider\Domain\Assembler\MusicOnHold;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;

class MusicOnHoldAssembler implements CustomEntityAssemblerInterface
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
        DataTransferObjectInterface $musicOnHoldDto,
        EntityInterface $musicOnHold,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($musicOnHold, MusicOnHoldInterface::class);
        $musicOnHold->updateFromDto($musicOnHoldDto, $fkTransformer);
        $this->handleEntityFiles($musicOnHold, $musicOnHoldDto, $fkTransformer);
    }
}
