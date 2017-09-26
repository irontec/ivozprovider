<?php

namespace Ivoz\Kam\Domain\Model\UsersWatcher;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UsersWatcherRepository extends ObjectRepository, Selectable{}

