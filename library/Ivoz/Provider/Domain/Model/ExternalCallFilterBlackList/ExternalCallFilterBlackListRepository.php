<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface ExternalCallFilterBlackListRepository extends ObjectRepository, Selectable
{
}
