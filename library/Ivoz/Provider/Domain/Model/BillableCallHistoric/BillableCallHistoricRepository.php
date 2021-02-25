<?php

namespace Ivoz\Provider\Domain\Model\BillableCallHistoric;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface BillableCallHistoricRepository extends ObjectRepository, Selectable
{

}
