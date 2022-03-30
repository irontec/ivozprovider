<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface HuntGroupRepository extends ObjectRepository, Selectable
{
}
