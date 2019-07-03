<?php

namespace Ivoz\Core\Application\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;

class QueryBuilderFactory
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param string $entityName
     * @param array|null $criteria
     * @param array|null $orderBy
     * @param integer|null $limit
     * @param integer|null $offset
     * @return QueryBuilder
     */
    public function createFromArguments($entityName, array $criteria = null, array $orderBy = null, $limit = null, $offset = null)
    {
        $repository = $this->em->getRepository($entityName);
        $alias = $this->getAlias($entityName);
        $qb = $repository->createQueryBuilder($alias);

        if (!is_null($criteria)) {
            $qb->where($criteria[0]);

            if (isset($criteria[1])) {
                $qb->setParameters($criteria[1]);
            }
        }

        if (!is_null($orderBy)) {
            foreach ($orderBy as $field => $order) {
                if (is_callable($order)) {
                    $order($qb);
                    continue;
                }

                preg_match('/\.*case .* as hidden ([^\s]+).*/i', $field, $caseOrder);
                if (count($caseOrder) !== 2) {
                    $qb->addOrderBy($field, $order);
                    continue;
                }

                $qb->addSelect($field);
                $qb->addOrderBy($caseOrder[1], $order);
            }
        }

        if (!is_null($offset)) {
            $qb->setFirstResult($offset);
        }

        if (!is_null($limit)) {
            $qb->setMaxResults($limit);
        }

        return $qb;
    }

    /**
     * @param string $entityName
     * @return string
     */
    public function getALias($entityName)
    {
        $namespace = explode('\\', $entityName);
        return end($namespace);
    }
}
