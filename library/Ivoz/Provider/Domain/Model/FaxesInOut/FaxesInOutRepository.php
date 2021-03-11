<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface FaxesInOutRepository extends ObjectRepository, Selectable
{

}
