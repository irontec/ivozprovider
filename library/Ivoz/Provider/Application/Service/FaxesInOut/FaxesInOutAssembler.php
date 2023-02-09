<?php

namespace Ivoz\Provider\Application\Service\FaxesInOut;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

class FaxesInOutAssembler implements CustomEntityAssemblerInterface
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
        DataTransferObjectInterface $faxesInOutDto,
        EntityInterface $faxesInOut,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($faxesInOut, FaxesInOutInterface::class);
        $faxesInOut->updateFromDto($faxesInOutDto, $fkTransformer);
        $this->handleEntityFiles($faxesInOut, $faxesInOutDto, $fkTransformer);
    }
}
