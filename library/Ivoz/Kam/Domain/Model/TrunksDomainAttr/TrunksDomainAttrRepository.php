<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface TrunksDomainAttrRepository extends ObjectRepository, Selectable
{

}
