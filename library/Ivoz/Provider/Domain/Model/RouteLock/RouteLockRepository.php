<?php

namespace Ivoz\Provider\Domain\Model\RouteLock;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface RouteLockRepository extends ObjectRepository, Selectable {}

