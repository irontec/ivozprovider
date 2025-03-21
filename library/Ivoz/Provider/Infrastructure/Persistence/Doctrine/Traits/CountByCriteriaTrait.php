<?php

namespace Ivoz\Provider\Infrastructure\Persistence\Doctrine\Traits;

use Doctrine\Common\Collections\Criteria;

trait CountByCriteriaTrait
{
    /**
     * @param Criteria $criteria
     * @return int
     */
    protected function countByCriteria(Criteria $criteria)
    {
        $qb = $this
            ->createQueryBuilder('self')
            ->select('count(self)')
            ->addCriteria($criteria);

        return (int) $qb
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    abstract public function createQueryBuilder($alias, $indexBy = null);
}
