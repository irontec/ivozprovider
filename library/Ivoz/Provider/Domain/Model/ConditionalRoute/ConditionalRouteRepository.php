<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface ConditionalRouteRepository extends ObjectRepository, Selectable
{

}
