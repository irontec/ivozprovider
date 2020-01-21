<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface MusicOnHoldRepository extends ObjectRepository, Selectable
{

}
