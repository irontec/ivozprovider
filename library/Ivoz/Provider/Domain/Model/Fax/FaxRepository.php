<?php

namespace Ivoz\Provider\Domain\Model\Fax;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface FaxRepository extends ObjectRepository, Selectable
{

}
