<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

use Doctrine\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface SpecialNumberRepository extends ObjectRepository, Selectable
{
}
