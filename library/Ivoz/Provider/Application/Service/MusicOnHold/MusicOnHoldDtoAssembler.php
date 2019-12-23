<?php

namespace Ivoz\Provider\Application\Service\MusicOnHold;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldDto;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;

class MusicOnHoldDtoAssembler implements CustomDtoAssemblerInterface
{
    protected $storagePathResolver;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    /**
     * @param MusicOnHoldInterface $musicOnHold
     * @throws \Exception
     */
    public function toDto(EntityInterface $musicOnHold, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($musicOnHold, MusicOnHoldInterface::class);

        /** @var MusicOnHoldDto $dto */
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
