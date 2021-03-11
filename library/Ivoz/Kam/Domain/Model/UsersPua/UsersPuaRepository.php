<?php

namespace Ivoz\Kam\Domain\Model\UsersPua;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface UsersPuaRepository extends ObjectRepository, Selectable
{

}
