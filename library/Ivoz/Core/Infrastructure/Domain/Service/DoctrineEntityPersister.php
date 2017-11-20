<?php

namespace Ivoz\Core\Infrastructure\Domain\Service;

use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\UnitOfWork;
use Ivoz\Core\Application\Service\CommandEventSubscriber;
use Ivoz\Core\Domain\Service\EntityEventSubscriber;
use Ivoz\Provider\Domain\Model\Changelog\Changelog;
use Ivoz\Provider\Domain\Model\Commandlog\Commandlog;

class DoctrineEntityPersister implements EntityPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

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

    public function __construct
    (
        EntityManagerInterface $em,
        CreateEntityFromDTO $createEntityFromDTO,
        UpdateEntityFromDTO $entityUpdater,
        CommandEventSubscriber $commandEventSubscriber,
        EntityEventSubscriber $entityEventSubscriber
    ) {
        $this->em = $em;
        $this->createEntityFromDTO = $createEntityFromDTO;
        $this->entityUpdater = $entityUpdater;
        $this->commandEventSubscriber = $commandEventSubscriber;
        $this->entityEventSubscriber = $entityEventSubscriber;
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
     *
     * @param boolean $dispatchImmediately
     * @return void
     */
    public function persist(EntityInterface $entity = null, $dispatchImmediately = false)
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
            $this->em->remove($entity);
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

    protected function transactional(EntityInterface $entity, callable $transaction)
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
                    break;
                }

                foreach ($this->pendingUpdates as $entity) {
                    $this->em->persist($entity);
                }
                $this->pendingUpdates = [];
                $this->em->flush();
            }

            $this->persistEvents();
            $this->em->flush();
        });

        $this->rootEntity = null;
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

        $entityEvents = $this
            ->entityEventSubscriber
            ->getEvents();

        foreach ($entityEvents as $event) {
            $changeLog = Changelog::fromEvent($event);
            $changeLog->setCommand($commandlog);
            $this->em->persist($changeLog);
        }

        $this->entityEventSubscriber->clearEvents();
    }
}
