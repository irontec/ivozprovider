<?php

namespace Ivoz\Provider\Application\Service\WebPortal;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalInterface;
use Assert\Assertion;

class WebPortalDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @var StoragePathResolverCollection
     */
    protected $storagePathResolver;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }


    /**
     * @param WebPortalInterface $entity
     * @param integer $depth
     * @return WebPortalDTO
     */
    public function toDto(EntityInterface $entity, $depth = 0, string $context = null)
    {
        Assertion::isInstanceOf($entity, WebPortalInterface::class);

        /** @var WebPortalDTO $dto */
        $dto = $entity->toDto($depth);
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        if ($entity->getLogo()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('Logo');

            $dto->setLogoPath(
                $pathResolver->getFilePath($entity)
            );
        }

        return $dto;
    }
}
