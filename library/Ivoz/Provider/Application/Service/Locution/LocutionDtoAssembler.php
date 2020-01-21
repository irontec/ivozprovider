<?php

namespace Ivoz\Provider\Application\Service\Locution;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

class LocutionDtoAssembler implements CustomDtoAssemblerInterface
{
    protected $storagePathResolver;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    /**
     * @param LocutionInterface $locution
     * @throws \Exception
     */
    public function toDto(EntityInterface $locution, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($locution, LocutionInterface::class);

        /** @var LocutionDTO $dto */
        $dto = $locution->toDto($depth);
        $id = $locution->getId();

        if (!$id) {
            return $dto;
        }

        if ($locution->getOriginalFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('OriginalFile');

            $pathResolver->setOriginalFileName(
                $locution->getOriginalFile()->getBaseName()
            );
            $dto->setOriginalFilepath(
                $pathResolver->getFilePath($locution)
            );
        }

        if ($locution->getEncodedFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('EncodedFile');

            $pathResolver->setOriginalFileName(
                $locution->getEncodedFile()->getBaseName()
            );
            $dto->setEncodedFilepath(
                $pathResolver->getFilePath($locution)
            );
        }

        return $dto;
    }
}
