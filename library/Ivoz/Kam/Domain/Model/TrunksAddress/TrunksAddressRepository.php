<?php

namespace Ivoz\Kam\Domain\Model\TrunksAddress;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface TrunksAddressRepository extends ObjectRepository, Selectable
{
}
