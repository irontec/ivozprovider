<?php

namespace Ivoz\Provider\Application\Service\FaxesInOut;

use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Assert\Assertion;

class FaxesInOutDtoAssembler implements CustomDtoAssemblerInterface
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
     * @param FaxesInOutInterface $entity
     * @param integer $depth
     * @return FaxesInOutDTO
     */
    public function toDto(EntityInterface $entity, $depth = 0)
    {
        Assertion::isInstanceOf($entity, FaxesInOutInterface::class);

        /** @var FaxesInOutDTO $dto */
        $dto = $entity->toDto($depth);
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        if ($entity->getFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('file');

            $dto->setFilePath(
                $pathResolver->getFilePath($entity)
            );
        }

        return $dto;
    }
}