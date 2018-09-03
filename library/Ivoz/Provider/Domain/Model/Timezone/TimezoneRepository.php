<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TimezoneRepository extends ObjectRepository, Selectable
{

}
