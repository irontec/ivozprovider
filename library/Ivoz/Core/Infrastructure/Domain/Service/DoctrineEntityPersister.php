<?php

namespace Ivoz\Core\Infrastructure\Domain\Service;

use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\Uuid;
use Ivoz\Core\Domain\Model\DomainEventPublisher;
use Doctrine\ORM\UnitOfWork;

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
     * @var string
     */
    protected $requestId;

    /**
     * @var bool
     */
    protected $rootEntity;

    /**
     * @var DomainEventPublisher
     */
    protected $eventPublisher;

    /**
     * @var EntityInterface[]
     */
    protected $pendingUpdates = [];

    public function __construct
    (
        EntityManagerInterface $em,
        CreateEntityFromDTO $createEntityFromDTO,
        UpdateEntityFromDTO $entityUpdater
    ) {
        $this->em = $em;
        $this->createEntityFromDTO = $createEntityFromDTO;
        $this->entityUpdater = $entityUpdater;

        $this->requestId = Uuid::uuid4()->toString();

        /**
         * @todo inject this service
         */
        $this->eventPublisher = DomainEventPublisher::getInstance();
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface|null $entity
     * @return EntityInterface|mixed
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

            $mustBePersisted = $this->rootEntity === $entity;
            if (!$mustBePersisted) {
                $oid = spl_object_hash($entity);
                $this->pendingUpdates[$oid] = $entity;
            }

            $state = $unitOfWork->getEntityState($entity);
            $singleComputationValidStates = [
                UnitOfWork::STATE_MANAGED,
                UnitOfWork::STATE_REMOVED
            ];

            if (in_array($state, $singleComputationValidStates)) {
                $this->em->flush($entity);
                return ;
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
        });

        $this->rootEntity = null;
    }
}
