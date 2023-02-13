<?php

namespace Ivoz\Provider\Application\Service\Ivr;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Provider\Domain\Model\Ivr\IvrDto;
use Ivoz\Provider\Domain\Model\Ivr\IvrInterface;
use Ivoz\Provider\Domain\Model\IvrExcludedExtension\IvrExcludedExtension;

class IvrDtoAssembler implements CustomDtoAssemblerInterface
{
    /**
     * @param IvrInterface $entity
     * @throws \Exception
     */
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, IvrInterface::class);

        $dto = $entity->toDto($depth);

        if (in_array($context, IvrDto::CONTEXTS_WITH_EXCLUDED_EXTENSIONS, true)) {
            $extensionIds = array_map(
                function (IvrExcludedExtension $excludedExtension) {
                    return (int) $excludedExtension
                        ->getExtension()
                        ->getId();
                },
                $entity->getExcludedExtensions()
            );

            $dto->setExcludedExtensionIds(
                $extensionIds
            );
        }

        return $dto;
    }
}
