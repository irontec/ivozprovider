<?php

namespace Ivoz\Provider\Domain\Model\ResidentialDevice;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface ResidentialDeviceRepository extends  ObjectRepository, Selectable
{

}


