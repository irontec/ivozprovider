<?php

namespace Ivoz\Provider\Domain\Assembler\WebPortal;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Service\Traits\FileContainerEntityAssemblerTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;

class WebPortalAssembler implements CustomEntityAssemblerInterface
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
        DataTransferObjectInterface $webPortalDto,
        EntityInterface $webPortal,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($webPortal, WebPortalInterface::class);
        $webPortal->updateFromDto($webPortalDto, $fkTransformer);
        $this->handleEntityFiles($webPortal, $webPortalDto, $fkTransformer);
    }
}
