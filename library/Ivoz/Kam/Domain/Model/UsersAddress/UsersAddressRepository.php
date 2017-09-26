<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UsersAddressRepository extends ObjectRepository, Selectable {}

