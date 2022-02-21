<?php

namespace Ivoz\Provider\Domain\Model\Location;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface LocationRepository extends ObjectRepository, Selectable
{

}
