<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TransformationRuleRepository extends ObjectRepository, Selectable
{
}
