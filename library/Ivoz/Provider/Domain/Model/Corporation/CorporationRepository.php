<?php

namespace Ivoz\Provider\Domain\Model\Corporation;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CorporationRepository extends ObjectRepository, Selectable
{
}
