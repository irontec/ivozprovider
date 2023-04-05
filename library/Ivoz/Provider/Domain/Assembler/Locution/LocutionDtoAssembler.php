<?php

namespace Ivoz\Provider\Domain\Assembler\Locution;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionDto;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;

class LocutionDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private StoragePathResolverCollection $storagePathResolver
    ) {
    }

    /**
     * @param LocutionInterface $locution
     * @throws \Exception
     */
    public function toDto(EntityInterface $locution, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($locution, LocutionInterface::class);

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
