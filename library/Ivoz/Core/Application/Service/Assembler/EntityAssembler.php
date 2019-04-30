<?php

namespace Ivoz\Core\Application\Service\Assembler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EntityAssembler
{
    protected $serviceContainer;
    protected $customAssemblers = [];
    private $fkTransformer;

    public function __construct(
        ForeignKeyTransformerInterface $fkTransformer,
        ContainerInterface $serviceContainer
    ) {
        $this->fkTransformer = $fkTransformer;
        $this->serviceContainer = $serviceContainer;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface $targetEntity
     * @return EntityInterface
     */
    public function updateFromDto(DataTransferObjectInterface $dto, EntityInterface $targetEntity)
    {
        $assembler = $this->getAssembler($dto);

        if ($assembler) {
            $assembler->fromDto(
                $dto,
                $targetEntity,
                $this->fkTransformer
            );
        } else {
            $targetEntity->updateFromDto(
                $dto,
                $this->fkTransformer
            );
        }

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
        $targetEntity = $entityName::fromDto(
            $dto,
            $this->fkTransformer
        );

        if ($assembler) {
            $assembler->fromDto(
                $dto,
                $targetEntity,
                $this->fkTransformer
            );
        }

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
     * @return \Ivoz\Core\Application\Service\Assembler\CustomEntityAssemblerInterface | null
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

    /**
     * @param DataTransferObjectInterface $dto
     * @return string
     */
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
