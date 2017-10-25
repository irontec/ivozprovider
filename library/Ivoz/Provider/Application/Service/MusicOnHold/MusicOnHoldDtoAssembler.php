<?php

namespace Ivoz\Provider\Application\Service\MusicOnHold;

use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandDTO;
use Assert\Assertion;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;
use Ivoz\Provider\Application\Service\GenericMusicOnHold\StoragePathResolver;

class MusicOnHoldDtoAssembler implements CustomDtoAssemblerInterface
{
    protected $originalFilePathResolver;
    protected $encodedFilePathResolver;

    public function __construct(
        string $localStoragePath,
        string $originalBasePath,
        string $encodedBasePath
    ) {
        $this->originalFilePathResolver = new StoragePathResolver(
            $localStoragePath,
            $originalBasePath,
            true,
            true
        );

        $this->encodedFilePathResolver = new StoragePathResolver(
            $localStoragePath,
            $encodedBasePath,
            true,
            true
        );
    }

    /**
     * @param MusicOnHoldInterface $entity
     * @return BrandDTO
     */
    public function toDTO(EntityInterface $entity)
    {
        Assertion::isInstanceOf($entity, MusicOnHoldInterface::class);

        /** @var BrandDTO $dto */
        $dto = $entity->toDTO();
        $id = $entity->getId();

        if (!$id) {
            return $dto;
        }

        /* OriginalFile */
        $this->originalFilePathResolver->setOriginalFileName(
            $entity->getOriginalFile()->getBaseName()
        );
        $dto->setOriginalFilePath(
            $this->originalFilePathResolver->getFilePath($entity)
        );

        /* EncodedFile */
        $this->encodedFilePathResolver->setOriginalFileName(
            $entity->getEncodedFile()->getBaseName()
        );
        $dto->setEncodedFilePath(
            $this->encodedFilePathResolver->getFilePath($entity)
        );

        return $dto;
    }
}