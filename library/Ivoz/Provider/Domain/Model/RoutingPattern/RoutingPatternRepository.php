<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RoutingPatternRepository extends ObjectRepository, Selectable
{

}
