<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface MusicOnHoldRepository extends ObjectRepository, Selectable
{
}
