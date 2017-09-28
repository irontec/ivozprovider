<?php

namespace Ivoz\Provider\Domain\Model\TransformationRulesetGroupsTrunk;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TransformationRulesetGroupsTrunkRepository extends ObjectRepository, Selectable
{
    public function countByCriteria(array $criteria);
}

