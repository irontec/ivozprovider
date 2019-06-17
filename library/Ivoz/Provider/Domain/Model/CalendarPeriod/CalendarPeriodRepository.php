<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CalendarPeriodRepository extends ObjectRepository, Selectable
{

}
