<?php

namespace Ivoz\Kam\Domain\Model\UsersHtable;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface UsersHtableRepository extends ObjectRepository, Selectable
{
}
