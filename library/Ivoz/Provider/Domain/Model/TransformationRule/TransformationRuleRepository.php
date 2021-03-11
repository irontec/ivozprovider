<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TransformationRuleRepository extends ObjectRepository, Selectable
{
}
