<?php

namespace Ivoz\Provider\Domain\Model\BillableCall;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface BillableCallRepository extends  ObjectRepository, Selectable
{

}


