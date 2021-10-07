<?php

namespace Ivoz\Provider\Application\Service\WebPortal;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;

class WebPortalDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private StoragePathResolverCollection $storagePathResolver
    ) {
    }

    /**
     * @param WebPortalInterface $webPortal
     * @throws \Exception
     */
    public function toDto(EntityInterface $webPortal, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($webPortal, WebPortalInterface::class);

        /** @var WebPortalDTO $dto */
        $dto = $webPortal->toDto($depth);
        $id = $webPortal->getId();

        if (!$id) {
            return $dto;
        }

        if ($webPortal->getLogo()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('Logo');

            $dto->setLogoPath(
                $pathResolver->getFilePath($webPortal)
            );
        }

        return $dto;
    }
}
