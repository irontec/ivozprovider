<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilter;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface ExternalCallFilterRepository extends ObjectRepository, Selectable
{

}
