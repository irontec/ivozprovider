<?php

namespace Ivoz\Core\Application\Service;

use Doctrine\ORM\EntityManager;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Event\CommandWasExecuted;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineEntityPersister;

/**
 * persistence data gateway for zend framework applications
 *
 * @author Mikel Madariaga <mikel@irontec.com>
 */
class DataGateway
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var QueryBuilderFactory
     */
    private $queryBuilderFactory;

    /**
     * @var DoctrineEntityPersister
     */
    private $entityPersister;

    /**
     * @var DtoAssembler
     */
    private $dtoAssembler;

    /**
     * @var DomainEventPublisher
     */
    protected $eventPublisher;

    /**
     * @var string
     */
    protected $requestId;

    /**
     * @var string
     */
    public static $user = '';

    /**
     * DataGateway constructor.
     * @param EntityManager $entityManager
     * @param QueryBuilderFactory $queryBuilderFactory
     * @param DoctrineEntityPersister $entityPersister
     * @param DtoAssembler $dtoAssembler
     * @param DomainEventPublisher $eventPublisher
     * @param RequestId $requestId
     */
    public function __construct(
        EntityManager $entityManager,
        QueryBuilderFactory $queryBuilderFactory,
        DoctrineEntityPersister $entityPersister,
        DtoAssembler $dtoAssembler,
        DomainEventPublisher $eventPublisher,
        RequestId $requestId
    ) {
        $this->em = $entityManager;
        $this->queryBuilderFactory = $queryBuilderFactory;
        $this->entityPersister = $entityPersister;
        $this->dtoAssembler = $dtoAssembler;
        $this->eventPublisher = $eventPublisher;
        $this->requestId = $requestId->toString();
    }

    /**
     * Gets the repository for an entity class.
     *
     * @param string $entityName The name of the entity.
     *
     * @return \Doctrine\ORM\EntityRepository The repository class.
     */
    private function getRepository(string $entityName)
    {
        return $this->em->getRepository($entityName);
    }

    /**
     * @param string $entityName
     * @param string $method
     * @return mixed
     */
    public function runNamedQuery(string $entityName, string $method, array $arguments)
    {
        $repository = $this->getRepository($entityName);

        return $repository
            ->{$method}(...$arguments);
    }


    /**
     * @param string $entityName
     * @return DataTransferObjectInterface[]
     */
    public function findAll(string $entityName)
    {
        $repository = $this->getRepository($entityName);
        $results = $repository->findAll();

        foreach ($results as $key => $result) {
            $results[$key] = $this->dtoAssembler->toDto($result);
        }

        return $results;
    }

    /**
     * @param string $entityName
     * @param mixed $id
     * @return DataTransferObjectInterface|null
     */
    public function find(string $entityName, $id)
    {
        $repository = $this->getRepository($entityName);
        $result = $repository->find($id);

        if (!is_null($result)) {
            return $this->dtoAssembler->toDto($result);
        }

        return null;
    }

    /**
     * @param string $entityName
     * @param array|null $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return DataTransferObjectInterface[]
     */
    public function findBy(
        string $entityName,
        array $criteria = null,
        array $orderBy = null,
        int $limit = null,
        int $offset = null
    ) {
        $query = $this
            ->queryBuilderFactory
            ->createFromArguments($entityName, $criteria, $orderBy, $limit, $offset)
            ->getQuery();

        $results = $query->getResult();

        $response = [];
        foreach ($results as $entity) {
            $response[] = $this->dtoAssembler->toDto($entity);
        }

        return $response;
    }


    /**
     * @param string $entityName
     * @param array | null $criteria
     * @param array | null $orderBy
     * @param int $chunkSize
     * @return \Generator
     */
    public function findAllBy(
        string $entityName,
        array $criteria = null,
        array $orderBy = null,
        int $chunkSize = 50
    ) {
        $qb = $this
            ->queryBuilderFactory
            ->createFromArguments($entityName, $criteria, $orderBy);

        $currentPage = 1;
        $continue =  true;
        while ($continue) {
            $qb
                ->setMaxResults($chunkSize)
                ->setFirstResult(($currentPage - 1) * $chunkSize);

            $query = $qb->getQuery();
            $results = $query->getResult();
            $continue = count($results) === $chunkSize;
            $currentPage++;

            foreach ($results as $result) {
                yield $this->dtoAssembler->toDto($result);
            }
        }
    }

    /**
     * @param string $entityName
     * @param array|null $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     * @return DataTransferObjectInterface | null
     */
    public function findOneBy(
        string $entityName,
        array $criteria = null,
        array $orderBy = null,
        int $limit = null,
        int $offset = null
    ) {
        /** @var DataTransferObjectInterface[] $response */
        $response = $this->findBy(
            $entityName,
            $criteria,
            $orderBy,
            $limit,
            $offset
        );

        return array_shift(
            $response
        );
    }

    /**
     * @param string $entityName
     * @param array|null $criteria
     * @return int
     */
    public function countBy(string $entityName, array $criteria = null)
    {
        $queryBuilder = $this
            ->queryBuilderFactory
            ->createFromArguments($entityName, $criteria);

        $select = 'count('. $this->queryBuilderFactory->getALias($entityName) .')';
        $queryBuilder->select($select);

        $query = $queryBuilder
            ->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * @param string $entityName
     * @param DataTransferObjectInterface $dto
     * @return void
     */
    public function persist(string $entityName, DataTransferObjectInterface $dto)
    {
        $this->triggerEvent(__CLASS__, __FUNCTION__, func_get_args());

        $entity = $this->entityPersister
            ->persistDto(
                $dto,
                null,
                true
            );

        $dto->setId(
            $entity->getId()
        );
    }

    /**
     * @param string $entityName
     * @param DataTransferObjectInterface $dto
     *
     * @throws \Exception
     *
     * @return void
     */
    public function update(string $entityName, DataTransferObjectInterface $dto)
    {
        $repository = $this->getRepository($entityName);
        $entity = $repository->find($dto->getId());

        if (!$entity) {
            throw new \Exception('Entity not found');
        }
        $this->triggerEvent(__CLASS__, __FUNCTION__, func_get_args());

        $this->entityPersister
            ->persistDto(
                $dto,
                $entity,
                true
            );
    }

    /**
     * @param string $entityName
     * @param array $ids
     *
     * @throws \Exception
     *
     * @return void
     */
    public function remove(string $entityName, array $ids)
    {
        $this->triggerEvent(__CLASS__, __FUNCTION__, func_get_args());

        $repository = $this->getRepository($entityName);
        $entities = [];
        foreach ($ids as $id) {
            $entity = $repository->find($id);
            if (is_null($entity)) {
                throw new \Exception('Entity #'. (string) $id .' not found', $id);
            }
            $entities[] = $entity;
        }

        $this->entityPersister->removeFromArray($entities);
    }

    /**
     * @param string $entityName
     * @param int $id
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function remoteProcedureCall(string $entityName, $id, $method, array $arguments)
    {
        $entity = $this
            ->em
            ->getReference($entityName, $id);

        $this->triggerEvent(__CLASS__, __FUNCTION__, func_get_args());

        return $entity
            ->{$method}(
                ...$arguments
            );
    }

    /**
     * @return void
     */
    private function triggerEvent(string $class, string $method, array $arguments)
    {
        foreach ($arguments as $key => $value) {
            if ($value instanceof DataTransferObjectInterface) {
                $arguments[$key] = $this->dtoToArray($value);
            } elseif (is_object($value)) {
                $arguments[$key] = 'object(' . get_class($value) . ')';
            }
        }

        $agent = [
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user' => self::$user,
        ];

        $event = new CommandWasExecuted(
            $this->requestId,
            $class,
            $method,
            $arguments,
            $agent
        );

        $this->eventPublisher->publish($event);
    }

    /**
     * @return array
     */
    private function dtoToArray(DataTransferObjectInterface $dto): array
    {
        $result = $dto->toArray(true);

        return $this
            ->walkArray($result);
    }

    /**
     * @return array
     */
    private function walkArray(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->walkArray($value);
            } elseif ($value instanceof DataTransferObjectInterface) {
                $data[$key] = '#' .$value->getId();
            }
        }

        return $data;
    }
}
