<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServer;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface ApplicationServerRepository extends ObjectRepository, Selectable
{

}
