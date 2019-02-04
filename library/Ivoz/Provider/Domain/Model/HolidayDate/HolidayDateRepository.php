<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;

interface HolidayDateRepository extends ObjectRepository, Selectable
{
    public function findMatchingDateSiblings(HolidayDateInterface $holidayDate);
}
