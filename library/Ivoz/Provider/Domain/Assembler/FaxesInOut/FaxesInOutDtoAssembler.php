<?php

namespace Ivoz\Provider\Domain\Assembler\FaxesInOut;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutDto;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;

class FaxesInOutDtoAssembler implements CustomDtoAssemblerInterface
{
    public function __construct(
        private StoragePathResolverCollection $storagePathResolver
    ) {
    }

    /**
     * @param FaxesInOutInterface $faxesInOut
     * @throws \Exception
     */
    public function toDto(EntityInterface $faxesInOut, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($faxesInOut, FaxesInOutInterface::class);

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
