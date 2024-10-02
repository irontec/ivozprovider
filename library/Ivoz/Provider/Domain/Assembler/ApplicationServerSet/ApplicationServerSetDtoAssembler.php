<?php

namespace Ivoz\Provider\Domain\Assembler\ApplicationServerSet;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\Assembler\CustomDtoAssemblerInterface;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSet;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerInterface;

class ApplicationServerSetDtoAssembler implements CustomDtoAssemblerInterface
{
    public function toDto(EntityInterface $entity, int $depth = 0, string $context = null): DataTransferObjectInterface
    {
        Assertion::isInstanceOf($entity, ApplicationServerSet::class);

        $dto = $entity->toDto($depth);
        $id = $entity->getId();

        if (is_null($id)) {
            return $dto;
        }

        if ($context === DataTransferObjectInterface::CONTEXT_SIMPLE) {
            return $dto;
        }

        $relApplicationServers = $entity->getRelApplicationServers();
        $applicationServerIds = array_map(
            function (ApplicationServerSetRelApplicationServerInterface $relApplicationServer) {
                return (int) $relApplicationServer
                    ->getApplicationServer()
                    ?->getId();
            },
            $relApplicationServers
        );

        $dto->setApplicationServers(
            $applicationServerIds
        );

        return $dto;
    }
}
