<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine\Traits;

use Doctrine\ORM\QueryBuilder;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;

trait GetGeneratorByConditionsTrait
{
    /**
     * @param array $conditions
     * @param int $batchSize
     * @param array|null $order
     * @return \Generator
     */
    public function getGeneratorByConditions(array $conditions, int $batchSize, array $order = null)
    {
        /** @var QueryBuilder $qb */
        $qb = $this->createQueryBuilder('self');
        $qb->addCriteria(CriteriaHelper::fromArray($conditions));

        if ($order) {
            $qb->orderBy(...$order);
        }

        $currentPage = 1;
        $continue =  true;
        while ($continue) {
            $qb
                ->setMaxResults($batchSize)
                ->setFirstResult(($currentPage -1) * $batchSize);

            $query = $qb->getQuery();
            $results = $query->getResult();
            $continue = count($results) === $batchSize;
            $currentPage++;

            yield $results;
        }
    }
}
