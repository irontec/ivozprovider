<?php

namespace Ivoz\Provider\Domain\Model\FixedCost;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface FixedCostRepository extends ObjectRepository, Selectable
{
}
