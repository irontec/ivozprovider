<?php

namespace Ivoz\Provider\Domain\Model\CallCsvReport;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface CallCsvReportRepository extends ObjectRepository, Selectable
{

}
