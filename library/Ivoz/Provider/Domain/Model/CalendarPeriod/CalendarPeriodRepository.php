<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CalendarPeriodRepository extends ObjectRepository, Selectable
{

}
