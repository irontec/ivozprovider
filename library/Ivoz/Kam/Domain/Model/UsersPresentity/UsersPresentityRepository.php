<?php

namespace Ivoz\Kam\Domain\Model\UsersPresentity;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UsersPresentityRepository extends ObjectRepository, Selectable {}

