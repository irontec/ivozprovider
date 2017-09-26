<?php

namespace Ivoz\Provider\Domain\Model\FixedCost;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface FixedCostRepository extends ObjectRepository, Selectable {}

