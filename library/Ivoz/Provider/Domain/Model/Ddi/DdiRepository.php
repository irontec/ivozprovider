<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface DdiRepository extends ObjectRepository, Selectable
{

}
