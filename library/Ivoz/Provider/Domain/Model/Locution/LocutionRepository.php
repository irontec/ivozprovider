<?php

namespace Ivoz\Provider\Domain\Model\Locution;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface LocutionRepository extends ObjectRepository, Selectable
{

}
