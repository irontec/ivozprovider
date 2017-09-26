<?php

namespace Ivoz\Kam\Domain\Model\UsersMissedCall;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UsersMissedCallRepository extends ObjectRepository, Selectable {}

