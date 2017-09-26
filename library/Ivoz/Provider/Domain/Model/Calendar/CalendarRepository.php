<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CalendarRepository extends ObjectRepository, Selectable {}

