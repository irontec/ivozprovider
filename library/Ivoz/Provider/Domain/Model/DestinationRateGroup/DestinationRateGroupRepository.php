<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface DestinationRateGroupRepository extends ObjectRepository, Selectable
{
}
