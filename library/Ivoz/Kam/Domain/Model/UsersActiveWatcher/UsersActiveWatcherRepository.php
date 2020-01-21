<?php

namespace Ivoz\Kam\Domain\Model\UsersActiveWatcher;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface UsersActiveWatcherRepository extends ObjectRepository, Selectable
{

}
