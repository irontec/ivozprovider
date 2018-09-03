<?php

namespace Ivoz\Provider\Domain\Model\Friend;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface FriendRepository extends ObjectRepository, Selectable
{

}
