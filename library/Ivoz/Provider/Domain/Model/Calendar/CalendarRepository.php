<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CalendarRepository extends ObjectRepository, Selectable
{
    public function findCompanyCalendar(int $companyId, int $calendarId): ?CalendarInterface;
}
