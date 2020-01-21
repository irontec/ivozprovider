<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface TransformationRuleSetRepository extends ObjectRepository, Selectable
{
    public function getIdsByBrandId(int $brandId): array;
}
