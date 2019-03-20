<?php

namespace Ivoz\Provider\Application\Service\DestinationRateGroup;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlDto;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;

class DestinationRateGroupDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @var StoragePathResolverCollection
     */
    protected $storagePathResolver;

    /**
     * DestinationRateGroupDtoAssembler constructor.
     *
     * @param StoragePathResolverCollection $storagePathResolver
     */
    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    /**
     * @param DestinationRateGroupInterface $entity
     * @param integer $depth
     * @return DestinationRateGroupDto
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, $depth = 0)
    {
        Assertion::isInstanceOf($entity, DestinationRateGroupInterface::class);

        /** @var DestinationRateGroupDto $dto */
        $dto = $entity->toDto($depth);
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        if ($entity->getFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('File');

            $pathResolver
                ->setOriginalFileName(
                    $entity->getFile()->getBaseName()
                );

            $dto->setFilePath(
                $pathResolver->getFilePath($entity)
            );
        }

        return $dto;
    }
}
