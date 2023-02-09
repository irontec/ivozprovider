<?php

namespace Ivoz\Provider\Domain\Model\Schedule;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface ScheduleRepository extends ObjectRepository, Selectable
{
}
