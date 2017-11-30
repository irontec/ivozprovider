<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UsersCdrRepository extends ObjectRepository, Selectable
{

}

