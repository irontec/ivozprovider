<?php

namespace Ivoz\Core\Application\Service;

use Doctrine\ORM\EntityManager;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Core\Application\Service\Assembler\EntityAssembler;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineEntityPersister;

/**
 * Entity service facade
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class EntityTools
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var DoctrineEntityPersister
     */
    private $entityPersister;


    /** @var EntityAssembler  */
    private $entityAssembler;

    /**
     * @var DtoAssembler
     */
    private $dtoAssembler;


    /**
     * EntityTools constructor.
     * @param EntityManager $entityManager
     * @param DoctrineEntityPersister $entityPersister
     * @param EntityAssembler $entityAssembler
     * @param DtoAssembler $dtoAssembler
     */
    public function __construct(
        EntityManager $entityManager,
        DoctrineEntityPersister $entityPersister,
        EntityAssembler $entityAssembler,
        DtoAssembler $dtoAssembler
    ) {
        $this->em = $entityManager;

        $this->entityPersister = $entityPersister;
        $this->entityAssembler = $entityAssembler;
        $this->dtoAssembler = $dtoAssembler;
    }

    /**
     * Gets the repository for an entity class.
     *
     * @param string $fqdn full entity class name.
     *
     * @return \Doctrine\ORM\EntityRepository The repository class.
     */
    public function getRepository(string $fqdn)
    {
        return $this
            ->em
            ->getRepository($fqdn);
    }

    public function entityToDto(EntityInterface $entity)
    {
        return $this
            ->dtoAssembler
            ->toDto($entity);
    }

    /**
     * @param EntityInterface $entity
     * @param boolean $dispatchImmediately
     * @return void
     */
    public function persist(EntityInterface $entity, $dispatchImmediately = false)
    {
        return $this
            ->entityPersister
            ->persist(
                $entity,
                $dispatchImmediately
            );
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface|null $entity
     * @param bool $dispatchImmediately
     * @return EntityInterface
     */
    public function persistDto(
        DataTransferObjectInterface $dto,
        EntityInterface $entity = null,
        $dispatchImmediately = false
    ) {
        return $this
            ->entityPersister
            ->persistDto($dto, $entity, $dispatchImmediately);
    }

    /**
     * @param EntityInterface $entity
     * @return void
     */
    public function remove(EntityInterface $entity)
    {
        return $this
            ->entityPersister
            ->remove($entity);
    }
}
