<?php

namespace Ivoz\Core\Infrastructure\Domain\Service;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\UnitOfWork;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Helper\EntityClassHelper;
use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Events as CustomEvents;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\OnCommitEventArgs;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\OnErrorEventArgs;

class DoctrineEntityPersister implements EntityPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var UnitOfWork
     * @deprecated
     */
    protected $unitOfWork;

    /**
     * @var \ReflectionProperty
     * @deprecated
     */
    protected $entityStateAccessor;

    /**
     * @var \ReflectionProperty
     * @deprecated
     */
    protected $orphanAccesor;

    /**
     * @var CreateEntityFromDTO
     */
    protected $createEntityFromDto;

    /**
     * @var UpdateEntityFromDTO
     */
    protected $entityUpdater;

    /**
     * @var EntityInterface | null
     */
    protected $rootEntity;

    /**
     * @var EntityInterface[]
     */
    protected $pendingUpdates = [];

    /**
     * @var array
     */
    protected $softDeleteMap = [];

    public function __construct(
        EntityManagerInterface $em,
        CreateEntityFromDTO $createEntityFromDTO,
        UpdateEntityFromDTO $entityUpdater,
        array $softDeleteMap
    ) {
        $this->em = $em;

        $this->unitOfWork = $this->em->getUnitOfWork();
        $unitOfWorkRef = new \ReflectionClass($this->unitOfWork);
        $this->entityStateAccessor = $unitOfWorkRef->getProperty('entityStates');
        $this->entityStateAccessor->setAccessible(true);

        $this->orphanAccesor = $unitOfWorkRef->getProperty('orphanRemovals');
        $this->orphanAccesor->setAccessible(true);

        $this->createEntityFromDto = $createEntityFromDTO;
        $this->entityUpdater = $entityUpdater;
        $this->softDeleteMap = $softDeleteMap;
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
        if ($dto->getId() && !$entity) {
            $entityClass = substr(
                get_class($dto),
                0,
                -3
            );

            /** @var EntityInterface $entity */
            $entity = $this->em->find(
                $entityClass,
                $dto->getId()
            );
        }

        if (is_null($entity)) {
            $entityClass = substr(get_class($dto), 0, -3);

            $entity = $this
                ->createEntityFromDto
                ->execute($entityClass, $dto);
        } else {
            $this->entityUpdater->execute($entity, $dto);
        }

        $this->persist($entity, $dispatchImmediately);

        return $entity;
    }

    /**
     * @param EntityInterface $entity
     * @param boolean $dispatchImmediately
     * @return void
     */
    public function persist(EntityInterface $entity, $dispatchImmediately = false)
    {
        $unitOfWork = $this->em->getUnitOfWork();
        $state = $unitOfWork->getEntityState($entity);
        $isNew = $state === UnitOfWork::STATE_NEW;
        $applyNow = ($dispatchImmediately || is_null($this->rootEntity));
        if ($isNew && $applyNow) {
            $this->em->persist($entity);
        }

        $transaction = function ($forcePersist = false) use ($entity, $dispatchImmediately, $unitOfWork) {

            $mustBePersisted = $forcePersist || $dispatchImmediately;
            if (!$mustBePersisted) {
                $oid = spl_object_hash($entity);
                $this->pendingUpdates[$oid] = $entity;
                return;
            }

            $state = $unitOfWork->getEntityState($entity);
            $singleComputationValidStates = [
                UnitOfWork::STATE_MANAGED,
                UnitOfWork::STATE_REMOVED
            ];

            $orphans = $this->orphanAccesor->getValue($unitOfWork);
            $this->orphanAccesor->setValue($unitOfWork, []);
            foreach ($orphans as $orphan) {
                $this->remove($orphan);
            }

            if (in_array($state, $singleComputationValidStates)) {
                $this->em->flush($entity);
                return;
            }

            $this->em->flush();
        };

        $this->transactional($entity, $transaction);
    }

    /**
     * @param EntityInterface $entity
     * @return void
     */
    public function remove(EntityInterface $entity)
    {
        $alreadyRemoved = $entity->hasBeenDeleted();
        if ($alreadyRemoved) {
            return;
        }

        $transaction = function () use ($entity) {

            $dependantEntities = $this->getDependantEntities($entity);
            foreach ($dependantEntities as $dependant) {
                $this->remove($dependant);
            }
            $oid = spl_object_hash($entity);
            $this->em->remove($entity);
            $this->em->flush();

            // This is a temporary hack in order to avoid cross reference issues
            // with doctrine when an entity has been removed
            // user <-> extension relationship for instance
            $entityStates = $this->entityStateAccessor->getValue($this->unitOfWork);
            $entityStates[$oid] = UnitOfWork::STATE_MANAGED;
            $this->entityStateAccessor->setValue($this->unitOfWork, $entityStates);
        };

        $this->transactional($entity, $transaction);
    }

    /**
     * @param EntityInterface[] $entities
     * @return void
     */
    public function removeFromArray(array $entities)
    {
        $transaction = function () use ($entities) {
            foreach ($entities as $entity) {
                $this->remove($entity);
            }
        };

        $this->transactional($entities[0], $transaction);
    }

    /**
     * @return void
     */
    public function dispatchQueued()
    {
        if (empty($this->pendingUpdates)) {
            return;
        }

        foreach ($this->pendingUpdates as $entity) {
            $this->em->persist($entity);
        }
        $this->pendingUpdates = [];

        $this->em->flush();
    }

    /**
     * @return void
     */
    private function transactional(EntityInterface $entity, callable $transaction)
    {
        try {
            $this->runTransactional($entity, $transaction);
        } catch (\Exception $exception) {
            $eventManager = $this->em->getEventManager();
            $eventManager->dispatchEvent(
                CustomEvents::onError,
                new OnErrorEventArgs($entity, $exception)
            );
        }
    }

    /**
     * @return void
     */
    private function runTransactional(EntityInterface $entity, callable $transaction)
    {
        if ($this->rootEntity instanceof EntityInterface) {
            $transaction(false);
            return;
        }

        $this->rootEntity = $entity;
        $connection = $this->em->getConnection();
        $eventManager = $this->em->getEventManager();
        $connection->transactional(function () use ($transaction, $eventManager) {
            $transaction(true);

            /**
             * Run until every pending insert/update order is applied
             */
            while (true) {
                if (empty($this->pendingUpdates)) {
                    // Trigger post [persist|remove] events
                    $this->em->flush();
                    break;
                }

                foreach ($this->pendingUpdates as $entity) {
                    $this->em->persist($entity);
                }
                $this->pendingUpdates = [];
                $this->em->flush();
            }

            $eventManager->dispatchEvent(
                CustomEvents::preCommit
            );
        });

        $eventManager->dispatchEvent(
            CustomEvents::onCommit,
            new OnCommitEventArgs($this->em)
        );
        $this->rootEntity = null;
    }

    /**
     * @return array
     */
    private function getDependantEntities(EntityInterface $entity): array
    {
        $dependantEntities = [];
        $entityClass = EntityClassHelper::getEntityClass($entity);
        if (!array_key_exists($entityClass, $this->softDeleteMap)) {
            return $dependantEntities;
        }

        $dependantEntityClasses = $this->softDeleteMap[$entityClass];
        $metadataFactory = $this
            ->em
            ->getMetadataFactory();

        foreach ($dependantEntityClasses as $dependantEntityClass) {
            /** @var ClassMetadata $entityMetadata */
            $entityMetadata = $metadataFactory->getMetadataFor($dependantEntityClass);
            $associations = $entityMetadata->getAssociationsByTargetClass($entityClass);
            foreach ($associations as $field => $association) {
                $isDeleteCascade =
                    isset($association['joinColumns'])
                    && $association['joinColumns'][0]['onDelete'] === 'cascade';

                if (!$isDeleteCascade) {
                    continue;
                }

                $repository = $this->em->getRepository($association['sourceEntity']);
                $results = $repository->findBy([
                    "$field" => $entity->getId()
                ]);

                if (!empty($results)) {
                    $dependantEntities = array_merge($dependantEntities, $results);
                }
            }
        }

        return $dependantEntities;
    }
}
