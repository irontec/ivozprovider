<?php

namespace ZfBundle\Services;

use Doctrine\ORM\EntityManager;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Command\CreateEntityFromDTO;
use Ivoz\Core\Application\Command\UpdateEntityFromDTO;

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
     * DataGateway constructor.
     * @param EntityManager $entityManager
     * @param \ZfBundle\Services\QueryBuilderFactory $QueryBuilderFactory
     * @param CreateEntityFromDTO $createEntityFromDTO
     * @param UpdateEntityFromDTO $entityUpdater
     */
    public function __construct(
        EntityManager $entityManager,
        QueryBuilderFactory $QueryBuilderFactory,
        CreateEntityFromDTO $createEntityFromDTO,
        UpdateEntityFromDTO $entityUpdater
    ) {
        $this->em = $entityManager;
        $this->queryBuilderFactory = $QueryBuilderFactory;
        $this->entityFactory = $createEntityFromDTO;
        $this->entityUpdater = $entityUpdater;
    }

    /**
     * Gets the repository for an entity class.
     *
     * @param string $entityName The name of the entity.
     *
     * @return \Doctrine\ORM\EntityRepository The repository class.
     */
    private function getRepository($entityName)
    {
        return $this->em->getRepository($entityName);
    }

    /**
     * @param string $entityName
     * @return DataTransferObjectInterface[]
     */
    public function findAll($entityName)
    {
        $repository = $this->getRepository($entityName);
        $results = $repository->findAll();

        foreach ($results as $key => $result) {
            $results[$key] = $result->toDTO();
        }

        return $results;
    }

    /**
     * @param string $entityName
     * @param mixed $id
     * @return DataTransferObjectInterface|null
     */
    public function find($entityName, $id)
    {
        $repository = $this->getRepository($entityName);
        $result = $repository->find($id);

        if (!is_null($result)) {
            return $result->toDTO();
        }

        return null;
    }

    /**
     * @param string $entityName
     * @param mixed $id
     * @return DataTransferObjectInterface|null
     * @throws \Exception
     */
    public function findOrFail($entityName, $id)
    {
        $response = $this->find($entityName, $id);
        if ($response) {
            return $response;
        }

        throw new \Exception('Entity #'. (string) $id .' not found', $id);
    }

    /**
     * @param string $entityName
     * @param array|null $criteria
     * @param array|null $orderBy
     * @param integer|null $limit
     * @param integer|null $offset
     * @return DataTransferObjectInterface[]
     */
    public function findBy($entityName, array $criteria = null, array $orderBy = null, $limit = null, $offset = null)
    {
        try {
            $query = $this
                ->queryBuilderFactory
                ->createFromArguments($entityName, $criteria, $orderBy, $limit, $offset)
                ->getQuery();
            $results = $query->getResult();
        } catch (\Exception $e) {
            dump($e);
            dump(func_get_args());
            die;
        }

        $response = [];
        foreach ($results as $entity) {
            $response[] = $entity->toDTO();
        }

        return $response;
    }

    /**
     * @param string $entityName
     * @param array|null $criteria
     * @return DataTransferObjectInterface
     */
    public function findOneBy($entityName, array $criteria = null)
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
    public function countBy($entityName, array $criteria = null)
    {
        $queryBuilder = $this
            ->queryBuilderFactory
            ->createFromArguments($entityName, $criteria);

        $select = 'count('. $this->queryBuilderFactory->getALias($entityName) .')';
        $queryBuilder->select($select);

        $query = $queryBuilder
            ->getQuery();

        try {
            $response = $query->getSingleScalarResult();
        } catch (\Exception $e) {
            dump($e);
            dump(func_get_args());
            die;
        }

        return $response;
    }

    public function persist($entityName, DataTransferObjectInterface $dto)
    {
        try {
            $entity = $this->entityFactory->execute($entityName, $dto);
            $this->em->persist($entity);
            $this->em->flush();
        } catch (\Exception $e) {
            dump($e);
            dump(func_get_args());
            die;
        }

        $dto->setId($entity->getId());
    }

    public function update($entityName, DataTransferObjectInterface $dto)
    {
        $repository = $this->getRepository($entityName);
        $entity = $repository->find($dto->getId());

        if (!$entity) {
            throw new \Exception('Entity not found');
        }
        $this->entityUpdater->execute($entity, $dto);

        try {
            $this->em->persist($entity);
            $this->em->flush();
        } catch (\Exception $e) {
            dump($e);
            dump(func_get_args());
            die;
        }
    }

    /**
     * @param string $entityName
     * @param array $ids
     */
    public function remove($entityName, array $ids)
    {
       try {
            $repository = $this->getRepository($entityName);
            foreach ($ids as $id) {
                $entity = $repository->find($id);
                if (is_null($entity)) {
                    throw new \Exception('Entity #'. (string) $id .' not found', $id);
                }

                $this->em->remove($entity);
            }
            $this->em->flush();
        } catch (\Exception $e) {
            dump($e);
            dump(func_get_args());
            die;
        }
    }

    public function remoteProcedureCall($entityName, $id, $method, array $arguments)
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
