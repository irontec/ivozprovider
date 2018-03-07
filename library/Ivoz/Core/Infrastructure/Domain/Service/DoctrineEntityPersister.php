<?php

namespace Ivoz\Core\Infrastructure\Domain\Service;

use Doctrine\Common\EventArgs;
use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\UnitOfWork;
use Ivoz\Core\Application\Service\CommandEventSubscriber;
use Ivoz\Core\Domain\Service\EntityEventSubscriber;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\OnCommitEventArgs;
use Ivoz\Provider\Domain\Model\Changelog\Changelog;
use Ivoz\Provider\Domain\Model\Commandlog\Commandlog;
use Ivoz\Core\Application\Helper\EntityClassHelper;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Events as CustomEvents;
use Psr\Log\LoggerInterface;

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
     * @var ReflectionProperty
     * @deprecated
     */
    protected $entityStateAccessor;

    /**
     * @var CreateEntityFromDTO
     */
    protected $createEntityFromDTO;

    /**
     * @var UpdateEntityFromDTO
     */
    protected $entityUpdater;

    /**
     * @var CommandEventSubscriber
     */
    protected $commandEventSubscriber;

    /**
     * @var EntityEventSubscriber
     */
    protected $entityEventSubscriber;

    /**
     * @var bool
     */
    protected $rootEntity;

    /**
     * @var EntityInterface[]
     */
    protected $pendingUpdates = [];

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var array
     */
    protected $softDeleteMap = [];

    public function __construct
    (
        EntityManagerInterface $em,
        CreateEntityFromDTO $createEntityFromDTO,
        UpdateEntityFromDTO $entityUpdater,
        CommandEventSubscriber $commandEventSubscriber,
        EntityEventSubscriber $entityEventSubscriber,
        LoggerInterface $logger,
        array $softDeleteMap
    ) {
        $this->em = $em;

        $this->unitOfWork = $this->em->getUnitOfWork();
        $unitOfWorkRef = new \ReflectionClass($this->unitOfWork);
        $this->entityStateAccessor = $unitOfWorkRef->getProperty('entityStates');
        $this->entityStateAccessor->setAccessible(true);

        $this->createEntityFromDTO = $createEntityFromDTO;
        $this->entityUpdater = $entityUpdater;
        $this->commandEventSubscriber = $commandEventSubscriber;
        $this->entityEventSubscriber = $entityEventSubscriber;
        $this->logger = $logger;
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
        if (is_null($entity)) {
            $entityClass = substr(get_class($dto), 0, -3);
            $entity = $this
                ->createEntityFromDTO
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
        if ($state ===  UnitOfWork::STATE_NEW && $dispatchImmediately) {
            $this->em->persist($entity);
        }

        $transaction = function () use ($entity, $dispatchImmediately, $unitOfWork) {

            $mustBePersisted = ($this->rootEntity === $entity) || $dispatchImmediately;
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

    private function transactional(EntityInterface $entity, callable $transaction)
    {
        if ($this->rootEntity instanceof EntityInterface) {
            $transaction();
            return;
        }

        $this->rootEntity = $entity;
        $connection = $this->em->getConnection();
        $connection->transactional(function () use ($transaction) {
            $transaction();

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

            $this->persistEvents();
        });

        $this->rootEntity = null;
        $eventManager = $this->em->getEventManager();
        $eventManager->dispatchEvent(
            CustomEvents::onCommit,
            new OnCommitEventArgs($this->em)
        );
    }

    private function getDependantEntities(EntityInterface $entity)
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

    private function persistEvents()
    {
        $command = $this
            ->commandEventSubscriber
            ->popEvent();

        if (!$command) {
            return;
        }

        $commandlog = Commandlog::fromEvent($command);
        $this->em->persist($commandlog);
        $this->logger->info(
            sprintf(
                '%s > %s::%s',
                (new \ReflectionClass($command))->getShortName(),
                $commandlog->getClass(),
                $commandlog->getMethod()
            )
        );

        $entityEvents = $this
            ->entityEventSubscriber
            ->getEvents();

        foreach ($entityEvents as $event) {
            $changeLog = Changelog::fromEvent($event);
            $changeLog->setCommand($commandlog);
            $this->em->persist($changeLog);

            $this->logger->info(
                sprintf(
                    '%s > %s#%s > %s',
                    (new \ReflectionClass($event))->getShortName(),
                    $changeLog->getEntity(),
                    $changeLog->getEntityId(),
                    json_encode($changeLog->getData())
                )
            );
        }

        $this->entityEventSubscriber->clearEvents();
        $this->em->flush();
    }
}
