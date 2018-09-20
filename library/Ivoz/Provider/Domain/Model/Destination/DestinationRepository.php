<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface DestinationRepository extends ObjectRepository, Selectable
{

}
