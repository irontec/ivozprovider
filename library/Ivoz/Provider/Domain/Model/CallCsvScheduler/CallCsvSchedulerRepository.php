<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface CallCsvSchedulerRepository extends  ObjectRepository, Selectable
{

}


