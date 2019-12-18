<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateInterface;

interface HolidayDateRepository extends ObjectRepository, Selectable
{
    public function findMatchingDateSiblings(HolidayDateInterface $holidayDate);
}
