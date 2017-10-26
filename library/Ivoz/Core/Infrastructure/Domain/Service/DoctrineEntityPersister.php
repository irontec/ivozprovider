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
        $mustBePersisted = ($this->rootEntity !== $entity);
        $transaction = function () use ($entity, $dispatchImmediately, $mustBePersisted) {

            if ($mustBePersisted) {
                $this->em->persist($entity);
            }

            if ($dispatchImmediately) {
                $this->em->flush($entity);
            }
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
             * Unit of work is recalculated every time flush is called,
             * so calling it again seems to be the only way to ensure that
             * there are no pending enqueued queries generated during entity lifecycle
             */
            $this->em->flush();
        });

        $this->rootEntity = null;
    }
}
