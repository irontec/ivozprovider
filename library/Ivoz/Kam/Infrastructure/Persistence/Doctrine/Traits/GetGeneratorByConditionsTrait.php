<?php

namespace Ivoz\Kam\Infrastructure\Persistence\Doctrine\Traits;

use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;

trait GetGeneratorByConditionsTrait
{
    public function getGeneratorByConditions(array $conditions, int $limit, array $order = null)
    {
        /**
         * @var \Doctrine\ORM\EntityRepository $this
         */
        $qb = $this->createQueryBuilder('self');
        $qb->addCriteria(CriteriaHelper::fromArray($conditions));

        if ($order) {
            $qb->orderBy(...$order);
        }

        $currentPage = 1;
        $continue =  true;
        while ($continue) {

            $qb
                ->setMaxResults($limit)
                ->setFirstResult(($currentPage -1) * $limit);

            $query = $qb->getQuery();
            $results = $query->getResult();
            $continue = count($results) === $limit;
            $currentPage++;

            yield $results;
        }
    }
}