<?php

namespace Ivoz\Kam\Domain\Model\TrunksDomainAttr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface TrunksDomainAttrRepository extends ObjectRepository, Selectable {}

