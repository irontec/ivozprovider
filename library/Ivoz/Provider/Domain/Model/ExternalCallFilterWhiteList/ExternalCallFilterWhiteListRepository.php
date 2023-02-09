<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface ExternalCallFilterWhiteListRepository extends ObjectRepository, Selectable
{
}
