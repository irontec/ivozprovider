<?php

namespace Ivoz\Provider\Application\Service\Locution;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

class LocutionDtoAssembler implements CustomDtoAssemblerInterface
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
     * @param LocutionInterface $entity
     * @param integer $depth
     * @return LocutionDTO
     */
    public function toDto(EntityInterface $entity, $depth = 0)
    {
        Assertion::isInstanceOf($entity, LocutionInterface::class);

        /** @var LocutionDTO $dto */
        $dto = $entity->toDto($depth);
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        if ($entity->getOriginalFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('OriginalFile');

            $pathResolver->setOriginalFileName(
                $entity->getOriginalFile()->getBaseName()
            );
            $dto->setOriginalFilepath(
                $pathResolver->getFilePath($entity)
            );
        }

        if ($entity->getEncodedFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('EncodedFile');

            $pathResolver->setOriginalFileName(
                $entity->getEncodedFile()->getBaseName()
            );
            $dto->setEncodedFilepath(
                $pathResolver->getFilePath($entity)
            );
        }

        return $dto;
    }
}
