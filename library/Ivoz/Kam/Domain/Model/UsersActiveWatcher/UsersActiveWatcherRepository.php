<?php

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UsersActiveWatcherRepository extends ObjectRepository, Selectable
{

}
