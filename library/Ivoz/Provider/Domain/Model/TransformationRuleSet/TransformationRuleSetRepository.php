<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TransformationRuleSetRepository extends ObjectRepository, Selectable
{
    public function countByCriteria(array $criteria);
}

