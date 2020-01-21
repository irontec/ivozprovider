<?php

namespace Ivoz\Provider\Domain\Model\FriendsPattern;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface FriendsPatternRepository extends ObjectRepository, Selectable
{

}
