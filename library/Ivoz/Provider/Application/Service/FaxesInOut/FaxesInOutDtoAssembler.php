<?php

namespace Ivoz\Provider\Application\Service\FaxesInOut;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

class FaxesInOutDtoAssembler implements CustomDtoAssemblerInterface
{
    protected $storagePathResolver;

    public function __construct(
        StoragePathResolverCollection $storagePathResolver
    ) {
        $this->storagePathResolver = $storagePathResolver;
    }

    /**
     * @param FaxesInOutInterface $faxesInOut
     * @throws \Exception
     */
    public function toDto(EntityInterface $faxesInOut, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($faxesInOut, FaxesInOutInterface::class);

        /** @var FaxesInOutDto $dto */
        $dto = $faxesInOut->toDto($depth);
        $id = $faxesInOut->getId();

        if (!$id) {
            return $dto;
        }

        if ($faxesInOut->getFile()->getFileSize()) {
            $pathResolver = $this
                ->storagePathResolver
                ->getPathResolver('file');

            $dto->setFilePath(
                $pathResolver->getFilePath($faxesInOut)
            );
        }

        return $dto;
    }
}
