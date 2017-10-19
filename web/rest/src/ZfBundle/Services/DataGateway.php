<?php

namespace ZfBundle\Services;

use Doctrine\ORM\EntityManager;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * @var UpdateEntityFromDTO
     */
    private $entityUpdater;

    /**
     * @var CreateEntityFromDTO
     */
    private $entityFactory;

    /**
     * @var DtoAssembler
     */
    private $dtoAssembler;

    /**
     * @var array
     */
    private $assemblers;

    /**
     * DataGateway constructor.
     * @param EntityManager $entityManager
     * @param \ZfBundle\Services\QueryBuilderFactory $queryBuilderFactory
     * @param CreateEntityFromDTO $createEntityFromDTO
     * @param UpdateEntityFromDTO $entityUpdater
     */
    public function __construct(
        EntityManager $entityManager,
        QueryBuilderFactory $queryBuilderFactory,
        CreateEntityFromDTO $createEntityFromDTO,
        UpdateEntityFromDTO $entityUpdater,
        DtoAssembler $dtoAssembler
    ) {
        $this->em = $entityManager;
        $this->queryBuilderFactory = $queryBuilderFactory;
        $this->entityFactory = $createEntityFromDTO;
        $this->entityUpdater = $entityUpdater;
        $this->dtoAssembler = $dtoAssembler;

        $this->assemblers = [];
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
            $results[$key] = $this->dtoAssembler->toDTO($result);
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
            return $this->dtoAssembler->toDTO($result);
        }

        return null;
    }

    /**
     * @param string $entityName
     * @param array|null $criteria
     * @param array|null $orderBy
     * @param integer|null $limit
     * @param integer|null $offset
     * @return DataTransferObjectInterface[]
     */
    public function findBy(string $entityName, array $criteria = null, array $orderBy = null, $limit = null, $offset = null)
    {
        $query = $this
            ->queryBuilderFactory
            ->createFromArguments($entityName, $criteria, $orderBy, $limit, $offset)
            ->getQuery();

        $results = $query->getResult();

        $response = [];
        foreach ($results as $entity) {
            $response[] = $this->dtoAssembler->toDTO($entity);
        }

        return $response;
    }

    /**
     * @param string $entityName
     * @param array|null $criteria
     * @return DataTransferObjectInterface
     */
    public function findOneBy(string $entityName, array $criteria = null)
    {
        $response = $this->findBy(
            $entityName,
            $criteria
        );

        return array_shift(
            $response
        );
    }

    /**
     * @param string $entityName
     * @param array|null $criteria
     * @return array
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

    public function persist(string $entityName, DataTransferObjectInterface $dto)
    {
        $entity = $this
            ->entityFactory
            ->execute(
                $entityName, $dto
            );

        $this->em->persist($entity);
        $this->em->flush();

        $dto->setId($entity->getId());
    }

    public function update(string $entityName, DataTransferObjectInterface $dto)
    {
        $repository = $this->getRepository($entityName);
        $entity = $repository->find($dto->getId());

        if (!$entity) {
            throw new \Exception('Entity not found');
        }
        $this->entityUpdater->execute($entity, $dto);

        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
     * @param string $entityName
     * @param array $ids
     */
    public function remove(string $entityName, array $ids)
    {
        $repository = $this->getRepository($entityName);
        foreach ($ids as $id) {
            $entity = $repository->find($id);
            if (is_null($entity)) {
                throw new \Exception('Entity #'. (string) $id .' not found', $id);
            }

            $this->em->remove($entity);
        }
        $this->em->flush();
    }

    public function remoteProcedureCall(string $entityName, $id, $method, array $arguments)
    {
        $entity = $this
            ->em
            ->getReference($entityName, $id);

        return $entity
            ->{$method}(
                ...$arguments
            );
    }
}
