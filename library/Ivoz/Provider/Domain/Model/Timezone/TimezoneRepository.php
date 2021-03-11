<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TimezoneRepository extends ObjectRepository, Selectable
{

}
