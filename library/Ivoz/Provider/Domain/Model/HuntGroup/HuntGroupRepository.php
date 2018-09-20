<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface HuntGroupRepository extends ObjectRepository, Selectable
{

}
