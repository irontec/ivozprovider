<?php

namespace Ivoz\Kam\Domain\Model\UsersLocationAttr;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface UsersLocationAttrRepository extends ObjectRepository, Selectable
{
}
