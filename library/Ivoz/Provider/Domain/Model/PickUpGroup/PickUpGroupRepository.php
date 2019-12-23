<?php

namespace Ivoz\Provider\Domain\Model\PickUpGroup;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface PickUpGroupRepository extends ObjectRepository, Selectable
{

}
