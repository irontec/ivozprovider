<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface RouteLockRepository extends ObjectRepository, Selectable
{

}
