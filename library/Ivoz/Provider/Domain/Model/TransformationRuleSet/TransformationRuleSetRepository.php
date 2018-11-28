<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TransformationRuleSetRepository extends ObjectRepository, Selectable
{
    /**
     * @param array $criteria
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * * @deprecated dead code
     */
    public function countByCriteria(array $criteria);
}
