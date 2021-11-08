<?php

namespace Ivoz\Provider\Application\Service\Brand;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;

class BrandAssembler implements CustomEntityAssemblerInterface
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
        DataTransferObjectInterface $brandDto,
        EntityInterface $brand,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($brand, BrandInterface::class);
        $brand->updateFromDto($brandDto, $fkTransformer);
        $this->handleEntityFiles($brand, $brandDto, $fkTransformer);
    }
}
