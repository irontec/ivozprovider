<?php

namespace Ivoz\Provider\Application\Service\DestinationRate;

use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlDto;
use Assert\Assertion;

class DestinationRateDtoAssembler implements CustomDtoAssemblerInterface
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
     * @param DestinationRateInterface $entity
     * @param integer $depth
     * @return BrandUrlDTO
     */
    public function toDto(EntityInterface $entity, $depth = 0)
    {
        Assertion::isInstanceOf($entity, DestinationRateInterface::class);

        /** @var BrandUrlDTO $dto */
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