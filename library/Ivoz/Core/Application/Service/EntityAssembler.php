<?php

namespace Ivoz\Core\Application\Service;

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
    protected $assemblers;

    public function __construct(
        ContainerInterface $serviceContainer
    ) {
        $this->serviceContainer = $serviceContainer;
        $this->assemblers = [];
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface $targetEntity
     * @return EntityInterface
     */
    public function updateFromDTO(DataTransferObjectInterface $dto, EntityInterface $targetEntity)
    {
        $assembler = $this->getAssembler($dto);

        return $assembler
            ? $assembler->fromDTO($dto, $targetEntity)
            : $targetEntity->updateFromDTO($dto);
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param string $entityName
     * @return EntityInterface
     */
    public function createFromDTO(DataTransferObjectInterface $dto, string $entityName)
    {
        $assembler = $this->getAssembler($dto);
        $targetEntity = $entityName::fromDTO($dto);

        return $assembler
            ? $assembler->fromDTO($dto, $targetEntity)
            : $targetEntity;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return mixed
     */
    private function getAssembler(DataTransferObjectInterface $dto)
    {
        $assembler = null;
        $entityClass = get_class($dto);

        if (array_key_exists($entityClass, $this->assemblers)) {
            $assembler = $this->assemblers[$entityClass];
        } else {
            $assembler = $this->create($dto);

            $this->assemblers[$entityClass] = $assembler;
        }

        return $assembler;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return null | DtoAssemblerInterface
     */
    private function create(DataTransferObjectInterface $dto)
    {
        $serviceClassName = $this->getServiceNameByDTO($dto);
        $serviceExists = $this->serviceContainer->has($serviceClassName);
        if (!$serviceExists) {
            return null;
        }

        return $this
            ->serviceContainer
            ->get($serviceClassName);
    }

    private function getServiceNameByDTO(DataTransferObjectInterface $dto)
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