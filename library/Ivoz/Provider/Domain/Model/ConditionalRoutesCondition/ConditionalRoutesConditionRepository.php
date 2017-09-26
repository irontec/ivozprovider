<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesCondition;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;


interface ConditionalRoutesConditionRepository extends ObjectRepository, Selectable {}

