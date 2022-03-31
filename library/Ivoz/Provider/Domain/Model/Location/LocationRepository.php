<?php

namespace Ivoz\Provider\Domain\Model\Location;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface LocationRepository extends ObjectRepository, Selectable
{
}
