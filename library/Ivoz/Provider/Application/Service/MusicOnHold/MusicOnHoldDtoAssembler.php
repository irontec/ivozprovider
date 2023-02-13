<?php

namespace Ivoz\Provider\Application\Service\MusicOnHold;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldDto;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;

class MusicOnHoldDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private StoragePathResolverCollection $storagePathResolver
    ) {
    }

    /**
     * @param MusicOnHoldInterface $musicOnHold
     * @throws \Exception
     */
    public function toDto(EntityInterface $musicOnHold, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($musicOnHold, MusicOnHoldInterface::class);

        $dto = $musicOnHold->toDto($depth);
        $id = $musicOnHold->getId();

        if (!$id) {
            return $dto;
        }

        /* OriginalFile */
        if ($musicOnHold->getOriginalFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('OriginalFile');

            $pathResolver->setOriginalFileName(
                $musicOnHold->getOriginalFile()->getBaseName()
            );
            $dto->setOriginalFilePath(
                $pathResolver->getFilePath($musicOnHold)
            );
        }

        /* EncodedFile */
        if ($musicOnHold->getEncodedFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('EncodedFile');

            $pathResolver->setOriginalFileName(
                $musicOnHold->getEncodedFile()->getBaseName()
            );
            $dto->setEncodedFilePath(
                $pathResolver->getFilePath($musicOnHold)
            );
        }

        return $dto;
    }
}
