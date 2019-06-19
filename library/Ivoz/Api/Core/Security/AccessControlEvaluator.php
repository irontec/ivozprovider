<?php

namespace Ivoz\Api\Core\Security;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class AccessControlEvaluator
{
    protected $em;
    protected $expressionLanguage;

    public function __construct(
        EntityManager $entityManager
    ) {
        $this->em = $entityManager;
        $this->expressionLanguage = new ExpressionLanguage();
    }

    /**
     * @param string $expression
     * @return mixed
     */
    public function evaluate(string $expression, array $variables)
    {
        return $this
            ->expressionLanguage
            ->evaluate(
                $expression,
                $variables
            );
    }


    public function getForeginKeysByCriteria(string $fqcn, Criteria $criteria)
    {
        $entityRepository = $this->em->getRepository($fqcn);
        $qb = $entityRepository->createQueryBuilder('self');

        $qb
            ->select('self.id')
            ->addCriteria($criteria);

        $result = $qb
            ->getQuery()
            ->getScalarResult();

        return array_column($result, 'id');
    }
}
