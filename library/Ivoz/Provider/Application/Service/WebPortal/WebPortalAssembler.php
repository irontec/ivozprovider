<?php

namespace Ivoz\Provider\Application\Service\WebPortal;

use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Assert\Assertion;
use Ivoz\Core\Application\Service\Traits\FileContainerEntityAssemblerTrait;

class WebPortalAssembler implements CustomEntityAssemblerInterface
{
    use FileContainerEntityAssemblerTrait;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

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
