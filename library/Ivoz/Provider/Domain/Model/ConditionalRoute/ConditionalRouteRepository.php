<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;


interface ConditionalRouteRepository extends ObjectRepository, Selectable {}

