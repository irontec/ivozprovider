<?php

namespace Ivoz\Kam\Domain\Model\UsersAcc;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UsersAccRepository extends ObjectRepository, Selectable {}

