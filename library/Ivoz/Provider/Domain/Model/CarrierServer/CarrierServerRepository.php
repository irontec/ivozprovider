<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CarrierServerRepository extends ObjectRepository, Selectable
{

}
