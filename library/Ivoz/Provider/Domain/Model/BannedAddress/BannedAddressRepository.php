<?php

namespace Ivoz\Provider\Domain\Model\BannedAddress;

use Doctrine\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface BannedAddressRepository extends ObjectRepository, Selectable
{
}
