<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriodsRelSchedule;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CalendarPeriodsRelScheduleRepository extends ObjectRepository, Selectable
{
}
