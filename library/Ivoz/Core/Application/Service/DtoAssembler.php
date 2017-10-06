<?php

namespace Ivoz\Core\Application\Service;

use Ivoz\Core\Domain\Model\EntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DtoAssembler
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

    public function toDTO(EntityInterface $targetEntity)
    {
        $assembler = $this->getAssembler($targetEntity);

        return $assembler
            ? $assembler->toDTO($targetEntity)
            : $targetEntity->toDTO();
    }

    private function getAssembler(EntityInterface $entity)
    {
        $assembler = null;
        $entityClass = get_class($entity);

        if (array_key_exists($entityClass, $this->assemblers)) {
            $assembler = $this->assemblers[$entityClass];
        } else {
            $assembler = $this->create($entity);
            $this->assemblers[$entityClass] = $assembler;
        }

        return $assembler;
    }

    /**
     * @param EntityInterface $targetEntity
     * @return null | DtoAssemblerInterface
     */
    private function create(EntityInterface $targetEntity)
    {
        $entityClass = get_class($targetEntity);
        $serviceClassName =
            str_replace(
                'Domain\\Model',
                'Application\\Service',
                $entityClass
            )
            . 'DtoAssembler';

        $serviceExists = $this->serviceContainer->has($serviceClassName);
        if (!$serviceExists) {
            return null;
        }

        return $this
            ->serviceContainer
            ->get($serviceClassName);
    }

}