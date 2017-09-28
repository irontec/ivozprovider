<?php

namespace Ivoz\Kam\Domain\Model\UsersDomainAttr;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface UsersDomainAttrRepository extends ObjectRepository, Selectable {}

