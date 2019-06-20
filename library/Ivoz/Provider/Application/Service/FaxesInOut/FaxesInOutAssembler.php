<?php

namespace Ivoz\Provider\Application\Service\FaxesInOut;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;

class FaxesInOutAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    public function fromDto(
        DataTransferObjectInterface $faxesInOutDto,
        EntityInterface $faxesInOut,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($faxesInOut, FaxesInOutInterface::class);
        $faxesInOut->updateFromDto($faxesInOutDto, $fkTransformer);
        $this->handleEntityFiles($faxesInOut, $faxesInOutDto, $fkTransformer);
    }
}
