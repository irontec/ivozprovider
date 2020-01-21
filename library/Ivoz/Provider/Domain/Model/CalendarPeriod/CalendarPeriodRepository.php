<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface CalendarPeriodRepository extends ObjectRepository, Selectable
{

}
