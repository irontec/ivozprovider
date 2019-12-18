<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface ConditionalRouteRepository extends ObjectRepository, Selectable
{

}
