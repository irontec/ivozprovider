<?php

namespace Ivoz\Core\Application\Service;

use Doctrine\ORM\EntityManager;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Core\Application\Service\Assembler\EntityAssembler;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineEntityPersister;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\PessimisticLockException;

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
     * @var UpdateEntityFromDTO
     */
    private $entityUpdater;


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
        DtoAssembler $dtoAssembler,
        UpdateEntityFromDTO $entityUpdater
    ) {
        $this->em = $entityManager;

        $this->entityPersister = $entityPersister;
        $this->entityAssembler = $entityAssembler;
        $this->dtoAssembler = $dtoAssembler;
        $this->entityUpdater = $entityUpdater;
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
     * lock entity or throw exception
     * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/transactions-and-concurrency.html#locking-support
     *
     * @param EntityInterface $entity
     * @param int $expectedVersion
     * @param int $lockMode
     *
     * @throws OptimisticLockException
     * @throws PessimisticLockException
     *
     * @return void
     */
    public function lock(EntityInterface $entity, int $expectedVersion, $lockMode = LockMode::OPTIMISTIC)
    {
        $this->em->lock($entity, $lockMode, $expectedVersion);
    }

    /**
     * @param EntityInterface $entity
     * @param boolean $dispatchImmediately
     * @return void
     */
    public function persist(EntityInterface $entity, $dispatchImmediately = false)
    {
        $this
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
        DataTransferObjectInterface &$dto,
        EntityInterface $entity = null,
        $dispatchImmediately = false
    ) {
        $entity = $this
            ->entityPersister
            ->persistDto($dto, $entity, $dispatchImmediately);

        // Resync dto
        $dto = $this->entityToDto($entity);

        return $entity;
    }

    public function updateEntityByDto(
        EntityInterface $entity,
        DataTransferObjectInterface $dto
    ): EntityInterface {
        $this->entityUpdater->execute(
            $entity,
            $dto
        );

        return $entity;
    }

    /**
     * @return void
     */
    public function dispatchQueuedOperations()
    {
        $this
            ->entityPersister
            ->dispatchQueued();
    }

    /**
     * @param EntityInterface $entity
     * @return void
     */
    public function remove(EntityInterface $entity)
    {
        $this
            ->entityPersister
            ->remove($entity);
    }

    /**
     * @param EntityInterface[] $entities
     * @return void
     */
    public function removeFromArray(array $entities)
    {
        $this
            ->entityPersister
            ->removeFromArray($entities);
    }

    /**
     * Clears the EntityManager. All entities that are currently managed
     * by this EntityManager become detached.
     *
     * @param string|null $entityName if given, only entities of this type will get detached
     *
     * @return void
     */
    public function clear($entityName = null)
    {
        if (!$entityName) {
            $this->em->clear();
            return;
        }

        $unitOfWork = $this->em->getUnitOfWork();
        $identityMap = $unitOfWork->getIdentityMap();

        if (!array_key_exists($entityName, $identityMap)) {
            return;
        }

        foreach ($identityMap[$entityName] as $entity) {
            $this->em->detach($entity);
        }
    }

    /**
     * Clears the EntityManager. All entities that are currently managed
     * except the one given
     *
     * @param string $entityNameToSkip if given, only entities of this type will not get detached
     *
     * @return void
     */
    public function clearExcept($entityNameToSkip)
    {
        $unitOfWork = $this->em->getUnitOfWork();
        $identityMap = $unitOfWork->getIdentityMap();

        foreach ($identityMap as $fqdn => $entities) {
            if ($fqdn === $entityNameToSkip) {
                continue;
            }

            foreach ($entities as $entity) {
                $this->em->detach($entity);
            }
        }
    }
}
