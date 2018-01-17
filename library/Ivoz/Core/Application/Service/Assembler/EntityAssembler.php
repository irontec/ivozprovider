<?php

namespace Ivoz\Core\Application\Service\Assembler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EntityAssembler
{
    /**
     * @var ContainerInterface
     */
    protected $serviceContainer;

    /**
     * @var array
     */
    protected $customAssemblers;

    public function __construct(
        ContainerInterface $serviceContainer
    ) {
        $this->serviceContainer = $serviceContainer;
        $this->customAssemblers = [];
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface $targetEntity
     * @return EntityInterface
     */
    public function updateFromDto(DataTransferObjectInterface $dto, EntityInterface $targetEntity)
    {
        $assembler = $this->getAssembler($dto);
        $assembler
            ? $assembler->fromDto($dto, $targetEntity)
            : $targetEntity->updateFromDto($dto);

        return $targetEntity;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param string $entityName
     * @return EntityInterface
     */
    public function createFromDto(DataTransferObjectInterface $dto, string $entityName)
    {
        $assembler = $this->getAssembler($dto);
        $targetEntity = $entityName::fromDto($dto);
        $assembler
            ? $assembler->fromDto($dto, $targetEntity)
            : $targetEntity;

        return $targetEntity;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return mixed
     */
    private function getAssembler(DataTransferObjectInterface $dto)
    {
        $assembler = null;
        $entityClass = get_class($dto);

        if (array_key_exists($entityClass, $this->customAssemblers)) {
            $assembler = $this->customAssemblers[$entityClass];
        } else {
            $assembler = $this->create($dto);

            $this->customAssemblers[$entityClass] = $assembler;
        }

        return $assembler;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return null | DtoAssemblerInterface
     */
    private function create(DataTransferObjectInterface $dto)
    {
        $serviceClassName = $this->getServiceNameByDto($dto);
        $serviceExists = $this->serviceContainer->has($serviceClassName);
        if (!$serviceExists) {
            return null;
        }

        return $this
            ->serviceContainer
            ->get($serviceClassName);
    }

    private function getServiceNameByDto(DataTransferObjectInterface $dto)
    {
        $entityClass = get_class($dto);
        return
            substr(
                str_replace(
                    'Domain\\Model',
                    'Application\\Service',
                    $entityClass
                ),
                0,
                -3
            )
            . 'Assembler';

    }

}